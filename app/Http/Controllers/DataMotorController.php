<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;

class DataMotorController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $data_motor = Motor::paginate(5);
            return view('admin.data-motor', compact('data_motor'));
        } elseif (auth()->user()->role === 'sales') {
            $data_motor = Motor::paginate(5);
            return view('sales.data-motor', compact('data_motor'));
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merk_motor' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'nullable|string',
            'spesifikasi' => 'nullable|string',
            'description' => 'nullable|string',
            'harga_awal' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'harga_setelah_diskon' => 'nullable|numeric',
        ]);

        $imagePath = $request->file('images') ? $request->file('images')->store('motor_images', 'public') : null;
        $hargaSetelahDiskon = $request->diskon
            ? $request->harga_awal - ($request->harga_awal * $request->diskon / 100)
            : $request->harga_awal;

        Motor::create([
            'nama_motor' => $request->nama_motor,
            'merk_motor' => $request->merk_motor,
            'images' => $imagePath,
            'caption' => $request->caption,
            'spesifikasi' => $request->spesifikasi,
            'description' => $request->description,
            'harga_awal' => $request->harga_awal,
            'diskon' => $request->diskon,
            'harga_setelah_diskon' => $hargaSetelahDiskon,
        ]);

        return redirect()->back()->with('success', 'Data motor berhasil ditambahkan.');
    }
    public function update(Request $request, Motor $motor)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merk_motor' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'nullable|string',
            'spesifikasi' => 'nullable|string',
            'description' => 'nullable|string',
            'harga_awal' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'harga_setelah_diskon' => 'nullable|numeric',
        ]);

        $data = $request->only(['nama_motor', 'merk_motor', 'caption', 'spesifikasi', 'description', 'harga_awal', 'diskon', 'harga_setelah_diskon']);

        // Hitung harga setelah diskon di backend
        $motor->harga_awal = $request->harga_awal;
        $motor->diskon = $request->diskon ?? 0;
        $motor->harga_setelah_diskon = $motor->harga_awal - ($motor->harga_awal * $motor->diskon / 100);
        $data['harga_setelah_diskon'] = $motor->harga_setelah_diskon;

        if ($request->hasFile('images')) {
            $data['images'] = $request->file('images')->store('motor_images', 'public');
        }

        $motor->update($data);
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.data-motor')->with('success', 'Data motor berhasil diupdate.');
        } elseif (auth()->user()->role === 'sales') {
            return redirect()->route('sales.data-motor')->with('success', 'Data motor berhasil diupdate.');
        }
    }


    public function destroy(Motor $motor)
    {
        if (auth()->user()->role === 'admin') {
            $motor->delete();
            return redirect()->route('admin.data-motor')->with('success', 'Data motor berhasil dihapus.');
        } elseif (auth()->user()->role === 'sales') {
            $motor->delete();
            return redirect()->route('sales.data-motor')->with('success', 'Data motor berhasil dihapus.');
        }
    }

    public function showByBrand($brand)
    {
        //ambil data dan disimpan ke variabel motors
        $motors = Motor::where('merk_motor', $brand)->get();

        //menentukan view berdasarkan merek
        $viewName = 'produk.' . strtolower($brand);

        if (!view()->exists($viewName)) {
            abort(404, 'Halaman motor untuk merek ' . $brand . ' tidak ditemukan.');
        }
        return view($viewName, compact('motors', 'brand'));
    }
}
