# Modul Permission dan Role Management

Modul ini menyediakan sistem manajemen permission dan role yang lengkap untuk Church Management System.

## Fitur yang Tersedia

### 1. Role Management

-   **Index**: Melihat daftar semua role dengan permission yang dimilikinya
-   **Create**: Membuat role baru dengan permission yang sesuai
-   **Edit**: Mengubah data role dan permission
-   **Show**: Melihat detail role dan permission yang dimiliki
-   **Delete**: Menghapus role (dengan validasi jika role sedang digunakan)

### 2. Permission Management

-   **Index**: Melihat daftar semua permission
-   **Create**: Membuat permission baru
-   **Edit**: Mengubah data permission
-   **Show**: Melihat detail permission dan role yang memilikinya
-   **Delete**: Menghapus permission (dengan validasi jika permission sedang digunakan)

### 3. Role Assignment

-   **Index**: Melihat daftar pengguna dengan role mereka
-   **Create**: Menugaskan role ke pengguna
-   **Edit**: Mengubah role yang ditugaskan ke pengguna

### 4. Permission Assignment

-   **Index**: Melihat daftar role dengan permission mereka
-   **Create**: Menugaskan permission ke role
-   **Edit**: Mengubah permission yang ditugaskan ke role

## Routes yang Tersedia

```php
// Role Management
Route::resource('roles', RoleController::class);

// Permission Management
Route::resource('permissions', PermissionController::class);

// Role Assignment
Route::get('role-assignments', [RoleAssignmentController::class, 'index'])->name('role-assignments.index');
Route::get('role-assignments/create', [RoleAssignmentController::class, 'create'])->name('role-assignments.create');
Route::post('role-assignments', [RoleAssignmentController::class, 'store'])->name('role-assignments.store');
Route::get('role-assignments/{id}/edit', [RoleAssignmentController::class, 'edit'])->name('role-assignments.edit');
Route::put('role-assignments/{id}', [RoleAssignmentController::class, 'update'])->name('role-assignments.update');

// Permission Assignment
Route::get('permission-assignments', [PermissionAssignmentController::class, 'index'])->name('permission-assignments.index');
Route::get('permission-assignments/create', [PermissionAssignmentController::class, 'create'])->name('permission-assignments.create');
Route::post('permission-assignments', [PermissionAssignmentController::class, 'store'])->name('permission-assignments.store');
Route::get('permission-assignments/{id}/edit', [PermissionAssignmentController::class, 'edit'])->name('permission-assignments.edit');
Route::put('permission-assignments/{id}', [PermissionAssignmentController::class, 'update'])->name('permission-assignments.update');
```

## Controller yang Dibuat

1. **RoleController** - Mengelola CRUD role
2. **PermissionController** - Mengelola CRUD permission
3. **RoleAssignmentController** - Mengelola penugasan role ke user
4. **PermissionAssignmentController** - Mengelola penugasan permission ke role

## View yang Dibuat

### Role Management

-   `resources/views/roles/index.blade.php` - Daftar role
-   `resources/views/roles/create.blade.php` - Form tambah role
-   `resources/views/roles/edit.blade.php` - Form edit role
-   `resources/views/roles/show.blade.php` - Detail role

### Permission Management

-   `resources/views/permissions/index.blade.php` - Daftar permission
-   `resources/views/permissions/create.blade.php` - Form tambah permission
-   `resources/views/permissions/edit.blade.php` - Form edit permission
-   `resources/views/permissions/show.blade.php` - Detail permission

### Role Assignment

-   `resources/views/role-assignments/index.blade.php` - Daftar penugasan role
-   `resources/views/role-assignments/create.blade.php` - Form tambah penugasan role
-   `resources/views/role-assignments/edit.blade.php` - Form edit penugasan role

### Permission Assignment

-   `resources/views/permission-assignments/index.blade.php` - Daftar penugasan permission
-   `resources/views/permission-assignments/create.blade.php` - Form tambah penugasan permission
-   `resources/views/permission-assignments/edit.blade.php` - Form edit penugasan permission

## Seeder yang Dibuat

**PermissionRoleSeeder** - Membuat permission dan role default:

-   Permission untuk semua modul (users, roles, permissions, members, ministries, events, finances)
-   Role default: Super Admin, Admin, Pastor, Sekretaris, Bendahara, Jemaat
-   Penugasan permission ke role sesuai dengan level akses

## Navigation Menu

Menu baru telah ditambahkan di sidebar:

-   **Role** - Akses ke manajemen role
-   **Permission** - Akses ke manajemen permission
-   **Tugas Role** - Akses ke penugasan role ke user
-   **Tugas Permission** - Akses ke penugasan permission ke role

## Cara Menggunakan

1. Jalankan seeder untuk membuat permission dan role default:

    ```bash
    php artisan db:seed --class=PermissionRoleSeeder
    ```

2. Akses menu Role, Permission, Tugas Role, atau Tugas Permission dari sidebar

3. Buat role dan permission sesuai kebutuhan sistem

4. Tugaskan role ke user melalui menu "Tugas Role"

5. Tugaskan permission ke role melalui menu "Tugas Permission"

## Validasi

-   Role tidak dapat dihapus jika sedang digunakan oleh user
-   Permission tidak dapat dihapus jika sedang digunakan oleh role
-   Form validasi untuk memastikan data yang dimasukkan valid
-   Error handling yang baik dengan pesan yang informatif

## Keamanan

-   Semua controller menggunakan middleware untuk validasi permission
-   Form menggunakan CSRF protection
-   Validasi input yang ketat
-   Sanitasi data sebelum disimpan ke database
