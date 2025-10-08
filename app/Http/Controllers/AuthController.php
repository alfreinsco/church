<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ], [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 karakter',
            ]);

            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                
                DB::commit();
                
                return redirect()->intended(route('dashboard'))->with('swal', [
                    'title' => 'Berhasil Login!',
                    'text' => 'Selamat datang di Church Management System',
                    'icon' => 'success'
                ]);
            }

            DB::rollBack();
            
            throw ValidationException::withMessages([
                'email' => 'Email atau password tidak sesuai',
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('swal', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan saat login. Silakan coba lagi.',
                'icon' => 'error'
            ])->withInput();
        }
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.register');
    }

    /**
     * Handle register request
     */
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'nullable|string|max:20',
            ], [
                'name.required' => 'Nama harus diisi',
                'name.max' => 'Nama maksimal 255 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sesuai',
                'phone.max' => 'Nomor telepon maksimal 20 karakter',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);

            // Assign member role by default
            $user->assignRole('member');

            Auth::login($user);

            DB::commit();

            return redirect()->route('dashboard')->with('swal', [
                'title' => 'Registrasi Berhasil!',
                'text' => 'Akun Anda telah berhasil dibuat. Selamat datang!',
                'icon' => 'success'
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('swal', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.',
                'icon' => 'error'
            ])->withInput();
        }
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('swal', [
                'title' => 'Berhasil Logout!',
                'text' => 'Anda telah berhasil keluar dari sistem',
                'icon' => 'success'
            ]);

        } catch (\Exception $e) {
            return redirect()->route('login')->with('swal', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan saat logout',
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ], [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.exists' => 'Email tidak terdaftar',
            ]);

            // For now, just show success message
            // In production, you would send reset email here
            
            return redirect()->route('login')->with('swal', [
                'title' => 'Link Reset Terkirim!',
                'text' => 'Silakan cek email Anda untuk reset password',
                'icon' => 'success'
            ]);

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan. Silakan coba lagi.',
                'icon' => 'error'
            ])->withInput();
        }
    }
}
