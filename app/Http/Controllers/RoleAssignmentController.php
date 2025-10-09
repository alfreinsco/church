<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleAssignmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:assign roles' => ['index', 'store', 'update'],
        ];
    }

    /**
     * Display a listing of users with their roles.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $query = User::with('roles');

            // Filter by role
            if ($request->has('role') && $request->role !== '') {
                $query->whereHas('roles', function ($q) use ($request) {
                    $q->where('name', $request->role);
                });
            }

            // Search by name or email
            if ($request->has('search') && $request->search !== '') {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('email', 'like', '%'.$request->search.'%');
                });
            }

            $users = $query->paginate(15);
            $roles = Role::all();

            DB::commit();

            return view('role-assignments.index', compact('users', 'roles'));

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
     * Show the form for assigning roles to a user.
     */
    public function create()
    {
        try {
            $users = User::all();
            $roles = Role::all();

            return view('role-assignments.create', compact('users', 'roles'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Store a newly assigned role.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'user_id' => 'required|exists:users,id',
                'roles' => 'required|array|min:1',
                'roles.*' => 'exists:roles,id',
            ]);

            $user = User::findOrFail($request->user_id);
            $roleIds = $request->roles;
            $roles = Role::whereIn('id', $roleIds)->pluck('name')->toArray();

            $user->syncRoles($roles);

            DB::commit();

            return redirect()->route('role-assignments.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Role berhasil ditugaskan ke pengguna',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menugaskan role: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    /**
     * Show the form for editing role assignments for a user.
     */
    public function edit(string $id)
    {
        try {
            $user = User::with('roles')->findOrFail($id);
            $roles = Role::all();

            return view('role-assignments.edit', compact('user', 'roles'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Update role assignments for a user.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'roles' => 'required|array|min:1',
                'roles.*' => 'exists:roles,id',
            ]);

            $user = User::findOrFail($id);
            $roleIds = $request->roles;
            $roles = Role::whereIn('id', $roleIds)->pluck('name')->toArray();

            $user->syncRoles($roles);

            DB::commit();

            return redirect()->route('role-assignments.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Role pengguna berhasil diperbarui',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memperbarui role: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }
}
