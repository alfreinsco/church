<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:view permissions' => ['index', 'show'],
            // 'permission:create permissions' => ['create', 'store'],
            // 'permission:edit permissions' => ['edit', 'update'],
            // 'permission:delete permissions' => ['destroy'],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $query = Permission::query();

            // Search by name
            if ($request->has('search') && $request->search !== '') {
                $query->where('name', 'like', '%'.$request->search.'%');
            }

            $permissions = $query->paginate(15);

            DB::commit();

            return view('permissions.index', compact('permissions'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data permission: '.$e->getMessage(),
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
            return view('permissions.create');

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
                'name' => 'required|string|max:255|unique:permissions,name',
            ]);

            Permission::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            DB::commit();

            return redirect()->route('permissions.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data permission berhasil ditambahkan',
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
            $permission = Permission::findOrFail($id);

            return view('permissions.show', compact('permission'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data permission: '.$e->getMessage(),
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
            $permission = Permission::findOrFail($id);

            return view('permissions.edit', compact('permission'));

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

            $permission = Permission::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,'.$id,
            ]);

            $permission->update([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('permissions.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data permission berhasil diperbarui',
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

            $permission = Permission::findOrFail($id);

            // Check if permission is being used by roles
            if ($permission->roles()->count() > 0) {
                return redirect()->back()->with('swal', [
                    'title' => 'Error',
                    'text' => 'Permission tidak dapat dihapus karena sedang digunakan oleh role',
                    'icon' => 'error',
                ]);
            }

            $permission->delete();

            DB::commit();

            return redirect()->route('permissions.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data permission berhasil dihapus',
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
