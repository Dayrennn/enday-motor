<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\User;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role; //role user yang sedang login
        $penjualan = Penjualan::with(['pelanggan', 'motor'])->latest()->paginate(5);
        $motor = Motor::all();
        $pelanggan = User::pelanggan()->get();

        if ($role === 'admin') {
            return view('admin.penjualan', [
                'penjualan' => $penjualan,
                'motor' => $motor,
                'pelanggan' => $pelanggan,
            ]);
        }

        if ($role === 'pelanggan') {
            return view('pelanggan.dashboard', [
                'penjualan' => $penjualan,
                'motors' => $motor,
                'pelanggan' => $pelanggan,
            ]);
        }
        if ($role === 'sales') {
            return view('sales.penjualan', [
                'penjualan' => $penjualan,
                'motor' => $motor,
                'pelanggan' => $pelanggan,
            ]);
        }

        return abort(403, 'Akses tidak diizinkan');
    }

    public function dashboard()
    {
        $userId = auth()->id();
        $penjualan = Penjualan::with(['motor'])
            ->where('pelanggan_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('pelanggan.dashboard', compact('penjualan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motor_id' => 'required',
            'pelanggan_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required',
            'status' => 'required|string|in:pending,dp,diproses,selesai,batal',
        ]);

        $motor = Motor::findOrFail($request->motor_id);
        $total = $motor->harga_setelah_diskon * $request->jumlah;
        Penjualan::create([

            'motor_id' => $request->motor_id,
            'pelanggan_id' => $request->pelanggan_id,
            'jumlah' => $request->jumlah,
            'total' => $total,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'kode_transaksi' => $request->kode_transaksi,
        ]);
        return back()->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'motor_id' => 'required',
            'pelanggan_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required',
            'status' => 'required|string|in:pending,dp,diproses,selesai,batal',
        ]);

        $motor = Motor::findOrFail($request->motor_id);
        $total = $motor->harga_setelah_diskon * $request->jumlah;

        $penjualan->update([
            'motor_id' => $request->motor_id,
            'pelanggan_id' => $request->pelanggan_id,
            'jumlah' => $request->jumlah,
            'total' => $total,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Penjualan berhasil diperbarui!');
    }
}
