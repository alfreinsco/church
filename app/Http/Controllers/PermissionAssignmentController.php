<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAssignmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:assign permissions' => ['index', 'store', 'update'],
        ];
    }

    /**
     * Display a listing of roles with their permissions.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $query = Role::with('permissions');

            // Filter by permission
            if ($request->has('permission') && $request->permission !== '') {
                $query->whereHas('permissions', function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->permission.'%');
                });
            }

            // Search by role name
            if ($request->has('search') && $request->search !== '') {
                $query->where('name', 'like', '%'.$request->search.'%');
            }

            $roles = $query->paginate(15);
            $permissions = Permission::all();

            DB::commit();

            return view('permission-assignments.index', compact('roles', 'permissions'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Show the form for assigning permissions to a role.
     */
    public function create()
    {
        try {
            $roles = Role::all();
            $permissions = Permission::all();

            return view('permission-assignments.create', compact('roles', 'permissions'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Store a newly assigned permission.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'role_id' => 'required|exists:roles,id',
                'permissions' => 'required|array|min:1',
                'permissions.*' => 'exists:permissions,id',
            ]);

            $role = Role::findOrFail($request->role_id);
            $permissionIds = $request->permissions;
            $permissions = Permission::whereIn('id', $permissionIds)->get();

            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()->route('permission-assignments.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Permission berhasil ditugaskan ke role',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menugaskan permission: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    /**
     * Show the form for editing permission assignments for a role.
     */
    public function edit(string $id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);
            $permissions = Permission::all();

            return view('permission-assignments.edit', compact('role', 'permissions'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Update permission assignments for a role.
     */
    public function update(Request $request, string $id)
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

            return redirect()->route('permission-assignments.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Permission role berhasil diperbarui',
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
