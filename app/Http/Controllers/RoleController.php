<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:view roles' => ['index', 'show'],
            // 'permission:create roles' => ['create', 'store'],
            // 'permission:edit roles' => ['edit', 'update'],
            // 'permission:delete roles' => ['destroy'],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $query = Role::with('permissions');

            // Search by name
            if ($request->has('search') && $request->search !== '') {
                $query->where('name', 'like', '%'.$request->search.'%');
            }

            $roles = $query->paginate(15);

            DB::commit();

            return view('roles.index', compact('roles'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data role: '.$e->getMessage(),
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
            $permissions = Permission::all();

            return view('roles.create', compact('permissions'));

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
                'name' => 'required|string|max:255|unique:roles,name',
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
            ]);

            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            // Assign permissions if provided
            if ($request->has('permissions')) {
                $permissionIds = $request->permissions;
                $permissions = Permission::whereIn('id', $permissionIds)->get();
                $role->syncPermissions($permissions);
            }

            DB::commit();

            return redirect()->route('roles.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data role berhasil ditambahkan',
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
            $role = Role::with('permissions')->findOrFail($id);

            return view('roles.show', compact('role'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data role: '.$e->getMessage(),
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
            $role = Role::with('permissions')->findOrFail($id);
            $permissions = Permission::all();

            return view('roles.edit', compact('role', 'permissions'));

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

            $role = Role::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,'.$id,
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
            ]);

            $role->update([
                'name' => $request->name,
            ]);

            // Update permissions
            if ($request->has('permissions')) {
                $permissionIds = $request->permissions;
                $permissions = Permission::whereIn('id', $permissionIds)->get();
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]);
            }

            DB::commit();

            return redirect()->route('roles.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data role berhasil diperbarui',
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

            $role = Role::findOrFail($id);

            // Check if role is being used by users
            if ($role->users()->count() > 0) {
                return redirect()->back()->with('swal', [
                    'title' => 'Error',
                    'text' => 'Role tidak dapat dihapus karena sedang digunakan oleh pengguna',
                    'icon' => 'error',
                ]);
            }

            $role->delete();

            DB::commit();

            return redirect()->route('roles.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data role berhasil dihapus',
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

    /**
     * Show the form for editing role assignments for a role.
     */
    public function assignPermissions(string $id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);
            $permissions = Permission::all();

            return view('roles.assign-permissions', compact('role', 'permissions'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Update role assignments for a role.
     */
    public function updateAssignPermissions(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'permissions' => 'required|array|min:1',
                'permissions.*' => 'exists:permissions,id',
            ]);

            $role = Role::findOrFail($id);
            $permissionIds = $request->permissions;
            $permissions = Permission::whereIn('id', $permissionIds)->get();

            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()->route('roles.assign-permissions', $id)->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Permission role berhasil ditugaskan',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memperbarui permission: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }
}
