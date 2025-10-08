<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:view users' => ['index', 'show'],
            // 'permission:create users' => ['create', 'store'],
            // 'permission:edit users' => ['edit', 'update'],
            // 'permission:delete users' => ['destroy'],
        ];
    }

    /**
     * Display a listing of the resource.
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

            return view('users.index', compact('users', 'roles'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data pengguna: '.$e->getMessage(),
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
            $roles = Role::all();

            return view('users.create', compact('roles'));

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
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|string|max:20',
                'password' => 'required|string|min:8|confirmed',
                'roles' => 'required|array|min:1',
                'roles.*' => 'exists:roles,id',
            ]);

            $data = $request->all();
            $data['password'] = Hash::make($request->password);

            $user = User::create($data);

            // Assign roles
            $roleIds = $request->roles;
            $roles = Role::whereIn('id', $roleIds)->pluck('name')->toArray();
            $user->assignRole($roles);

            DB::commit();

            return redirect()->route('users.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pengguna berhasil ditambahkan',
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
            $user = User::with('roles')->findOrFail($id);

            return view('users.show', compact('user'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data pengguna: '.$e->getMessage(),
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
            $user = User::with('roles')->findOrFail($id);
            $roles = Role::all();

            return view('users.edit', compact('user', 'roles'));

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

            $user = User::findOrFail($id);

            $validationRules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
                'phone' => 'nullable|string|max:20',
                'roles' => 'required|array|min:1',
                'roles.*' => 'exists:roles,id',
            ];

            // Only validate password if provided
            if ($request->filled('password')) {
                $validationRules['password'] = 'string|min:8|confirmed';
            }

            $request->validate($validationRules);

            $data = $request->only(['name', 'email', 'phone']);

            // Update password if provided
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            // Update roles
            $roleIds = $request->roles;
            $roles = Role::whereIn('id', $roleIds)->pluck('name')->toArray();
            $user->syncRoles($roles);

            DB::commit();

            return redirect()->route('users.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pengguna berhasil diperbarui',
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

            $user = User::findOrFail($id);

            // Prevent deleting own account
            if ($user->id === Auth::id()) {
                return redirect()->back()->with('swal', [
                    'title' => 'Error',
                    'text' => 'Tidak dapat menghapus akun sendiri',
                    'icon' => 'error',
                ]);
            }

            $user->delete();

            DB::commit();

            return redirect()->route('users.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data pengguna berhasil dihapus',
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
