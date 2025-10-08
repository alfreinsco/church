<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MinistryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:view ministries' => ['index', 'show'],
            // 'permission:create ministries' => ['create', 'store'],
            // 'permission:edit ministries' => ['edit', 'update'],
            // 'permission:delete ministries' => ['destroy'],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $query = Ministry::with(['leader', 'members', 'createdBy']);

            // Filter by status
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }

            // Filter by category
            if ($request->has('category') && $request->category !== '') {
                $query->where('category', $request->category);
            }

            // Search by name
            if ($request->has('search') && $request->search !== '') {
                $query->where('name', 'like', '%'.$request->search.'%');
            }

            $ministries = $query->paginate(15);

            DB::commit();

            return view('ministries.index', compact('ministries'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data pelayanan: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $members = Member::select('id', 'name')->get();

            return view('ministries.create', compact('members'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|max:255',
                'status' => 'required|in:aktif,tidak aktif',
                'leader_id' => 'nullable|exists:members,id',
            ]);

            $data = $request->all();
            $data['created_by'] = Auth::id();

            Ministry::create($data);

            DB::commit();

            return redirect()->route('ministries.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pelayanan berhasil ditambahkan',
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $ministry = Ministry::with([
                'leader', 'members', 'schedules', 'attendances.member',
                'createdBy', 'updatedBy',
            ])->findOrFail($id);

            return view('ministries.show', compact('ministry'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data pelayanan: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $ministry = Ministry::findOrFail($id);
            $members = Member::select('id', 'name')->get();

            return view('ministries.edit', compact('ministry', 'members'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $ministry = Ministry::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|string|max:255',
                'status' => 'required|in:aktif,tidak aktif',
                'leader_id' => 'nullable|exists:members,id',
            ]);

            $data = $request->all();
            $data['updated_by'] = Auth::id();

            $ministry->update($data);

            DB::commit();

            return redirect()->route('ministries.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pelayanan berhasil diperbarui',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $ministry = Ministry::findOrFail($id);
            $ministry->delete();

            DB::commit();

            return redirect()->route('ministries.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pelayanan berhasil dihapus',
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
