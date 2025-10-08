<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Ministry;
use App\Models\Event;
use App\Models\Offering;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            DB::beginTransaction();
            
            // Get statistics
            $totalMembers = Member::count();
            $activeMembers = Member::where('status', 'aktif')->count();
            $totalMinistries = Ministry::where('status', 'aktif')->count();
            $upcomingEvents = Event::where('start_date', '>=', now()->toDateString())
                                 ->where('status', 'published')
                                 ->count();
            
            // Get monthly offering
            $monthlyOffering = Offering::whereMonth('date', now()->month)
                                     ->whereYear('date', now()->year)
                                     ->sum('amount');
            
            // Get monthly expense
            $monthlyExpense = Expense::whereMonth('date', now()->month)
                                   ->whereYear('date', now()->year)
                                   ->sum('amount');
            
            // Get recent members
            $recentMembers = Member::with(['family', 'createdBy'])
                                  ->latest()
                                  ->limit(5)
                                  ->get();
            
            // Get upcoming events
            $upcomingEventsList = Event::with(['organizer'])
                                      ->where('start_date', '>=', now()->toDateString())
                                      ->where('status', 'published')
                                      ->orderBy('start_date')
                                      ->limit(5)
                                      ->get();
            
            // Get offering by category
            $offeringByCategory = Offering::select('category', DB::raw('SUM(amount) as total'))
                                         ->whereMonth('date', now()->month)
                                         ->whereYear('date', now()->year)
                                         ->groupBy('category')
                                         ->get();
            
            // Get expense by category
            $expenseByCategory = Expense::select('category', DB::raw('SUM(amount) as total'))
                                      ->whereMonth('date', now()->month)
                                      ->whereYear('date', now()->year)
                                      ->groupBy('category')
                                      ->get();
            
            DB::commit();
            
            return view('dashboard', compact(
                'totalMembers',
                'activeMembers',
                'totalMinistries',
                'upcomingEvents',
                'monthlyOffering',
                'monthlyExpense',
                'recentMembers',
                'upcomingEventsList',
                'offeringByCategory',
                'expenseByCategory'
            ));
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat dashboard: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }
}
