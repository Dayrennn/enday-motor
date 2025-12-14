<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $contacts = Contact::paginate(5);
            return view('admin.contact', compact('contacts'));
        } elseif (auth()->user()->role === 'sales') {
            $contacts = Contact::paginate(5);
            return view('sales.contact', compact('contacts'));
        }
    }
    public function submitForm(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Simpan data kontak ke database
        Contact::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan Anda telah terkirim! Mohon tunggu balasan dari kami, melalui email atau nomor telepon yang Anda berikan.');
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dibaca,closed',
        ]);

        $contact->status = $request->status;
        $contact->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
}
