<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // penting untuk keamanan
            $role = Auth::user()->role;

            // Redirect berdasarkan role
            switch ($role) {
                case 'admin':
                    return redirect()->intended('admin/dashboard');
                case 'owner':
                    return redirect()->intended('owner/dashboard');
                case 'pelanggan':
                    return redirect()->intended('pelanggan/dashboard');
                case 'sales':
                    return redirect()->intended('sales/dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors([
                        'username' => 'Role tidak dikenali.',
                    ])->withInput($request->only('username'));
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    // Logout
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
