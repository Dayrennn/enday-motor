<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddUser;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required',
            'role'      => 'required',
            'password'  => 'required|confirmed|min:3'
        ]);

        // Cek nomor telepon sudah dipakai atau belum
        if (\App\Models\User::where('phone', $request->phone)->exists()) {
            return back()
                ->with('phone_error', 'Nomor telepon sudah terdaftar!')
                ->withInput();
        }

        // Simpan data user baru (model AddUser)
        \App\Models\AddUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }
}
