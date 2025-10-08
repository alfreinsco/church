<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Member;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:view finances' => ['index', 'show'],
            // 'permission:create offerings' => ['createOffering', 'storeOffering'],
            // 'permission:edit offerings' => ['editOffering', 'updateOffering'],
            // 'permission:delete offerings' => ['destroyOffering'],
            // 'permission:create expenses' => ['createExpense', 'storeExpense'],
            // 'permission:edit expenses' => ['editExpense', 'updateExpense'],
            // 'permission:delete expenses' => ['destroyExpense'],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            // Get offerings
            $offeringsQuery = Offering::with(['member', 'createdBy']);
            if ($request->has('date_from') && $request->date_from) {
                $offeringsQuery->where('date', '>=', $request->date_from);
            }
            if ($request->has('date_to') && $request->date_to) {
                $offeringsQuery->where('date', '<=', $request->date_to);
            }
            $offerings = $offeringsQuery->orderBy('date', 'desc')->paginate(15, ['*'], 'offerings_page');

            // Get expenses
            $expensesQuery = Expense::with(['createdBy']);
            if ($request->has('date_from') && $request->date_from) {
                $expensesQuery->where('date', '>=', $request->date_from);
            }
            if ($request->has('date_to') && $request->date_to) {
                $expensesQuery->where('date', '<=', $request->date_to);
            }
            $expenses = $expensesQuery->orderBy('date', 'desc')->paginate(15, ['*'], 'expenses_page');

            // Get summary
            $totalOfferings = Offering::when($request->has('date_from') && $request->date_from, function ($query) use ($request) {
                $query->where('date', '>=', $request->date_from);
            })->when($request->has('date_to') && $request->date_to, function ($query) use ($request) {
                $query->where('date', '<=', $request->date_to);
            })->sum('amount');

            $totalExpenses = Expense::when($request->has('date_from') && $request->date_from, function ($query) use ($request) {
                $query->where('date', '>=', $request->date_from);
            })->when($request->has('date_to') && $request->date_to, function ($query) use ($request) {
                $query->where('date', '<=', $request->date_to);
            })->sum('amount');

            $balance = $totalOfferings - $totalExpenses;

            DB::commit();

            return view('finances.index', compact('offerings', 'expenses', 'totalOfferings', 'totalExpenses', 'balance'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data keuangan: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    // Offering methods
    public function createOffering()
    {
        try {
            $members = Member::select('id', 'name')->get();

            return view('finances.create-offering', compact('members'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    public function storeOffering(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'member_id' => 'nullable|exists:members,id',
                'amount' => 'required|numeric|min:0',
                'type' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'date' => 'required|date',
                'description' => 'nullable|string',
                'payment_method' => 'nullable|string|max:255',
            ]);

            $data = $request->all();
            $data['created_by'] = Auth::id();

            Offering::create($data);

            DB::commit();

            return redirect()->route('finances.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data persembahan berhasil ditambahkan',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    public function editOffering(string $id)
    {
        try {
            $offering = Offering::findOrFail($id);
            $members = Member::select('id', 'name')->get();

            return view('finances.edit-offering', compact('offering', 'members'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    public function updateOffering(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $offering = Offering::findOrFail($id);

            $request->validate([
                'member_id' => 'nullable|exists:members,id',
                'amount' => 'required|numeric|min:0',
                'type' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'date' => 'required|date',
                'description' => 'nullable|string',
                'payment_method' => 'nullable|string|max:255',
            ]);

            $data = $request->all();
            $data['updated_by'] = Auth::id();

            $offering->update($data);

            DB::commit();

            return redirect()->route('finances.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data persembahan berhasil diperbarui',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memperbarui data: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    public function destroyOffering(string $id)
    {
        try {
            DB::beginTransaction();

            $offering = Offering::findOrFail($id);
            $offering->delete();

            DB::commit();

            return redirect()->route('finances.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data persembahan berhasil dihapus',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menghapus data: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    // Expense methods
    public function createExpense()
    {
        try {
            return view('finances.create-expense');

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    public function storeExpense(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'description' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0',
                'category' => 'required|string|max:255',
                'date' => 'required|date',
                'payment_method' => 'nullable|string|max:255',
                'receipt_number' => 'nullable|string|max:255',
                'notes' => 'nullable|string',
            ]);

            $data = $request->all();
            $data['created_by'] = Auth::id();

            Expense::create($data);

            DB::commit();

            return redirect()->route('finances.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pengeluaran berhasil ditambahkan',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    public function editExpense(string $id)
    {
        try {
            $expense = Expense::findOrFail($id);

            return view('finances.edit-expense', compact('expense'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    public function updateExpense(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $expense = Expense::findOrFail($id);

            $request->validate([
                'description' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0',
                'category' => 'required|string|max:255',
                'date' => 'required|date',
                'payment_method' => 'nullable|string|max:255',
                'receipt_number' => 'nullable|string|max:255',
                'notes' => 'nullable|string',
            ]);

            $data = $request->all();
            $data['updated_by'] = Auth::id();

            $expense->update($data);

            DB::commit();

            return redirect()->route('finances.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pengeluaran berhasil diperbarui',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memperbarui data: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    public function destroyExpense(string $id)
    {
        try {
            DB::beginTransaction();

            $expense = Expense::findOrFail($id);
            $expense->delete();

            DB::commit();

            return redirect()->route('finances.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pengeluaran berhasil dihapus',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menghapus data: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
