<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return redirect()->route('login');
    }

    public function test()
    {
        return redirect()->back()->with(['swal' => [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]]);
    }
}
