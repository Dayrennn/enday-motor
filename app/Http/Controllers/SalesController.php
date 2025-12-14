<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\User;
use App\Models\Contact;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index()
    {
        // Total Penjualan
        $totalPenjualan = Penjualan::whereIn('status', ['dp', 'diproses', 'selesai'])
            ->get()
            ->sum(function ($p) {
                if ($p->status == 'dp') {
                    return $p->total * 0.2; // DP hanya 20%
                }
                return $p->total; // diproses & selesai = full harga
            });

        $totalPenjualanFormatted = number_format($totalPenjualan, 0, ',', '.');

        // Total Unit Terjual
        $totalUnitTerjual = Penjualan::whereIn('status', ['diproses', 'selesai'])
            ->sum('jumlah');

        // Jumlah Pelanggan
        $jumlahPelanggan = User::where('role', 'pelanggan')->count();

        // Pesan Masuk (yang belum dibaca)
        $pesanMasuk = Contact::where('status', '!=', 'dibaca')->count();

        return view('sales.dashboard', compact(
            'totalPenjualanFormatted',
            'totalUnitTerjual',
            'jumlahPelanggan',
            'pesanMasuk'
        ));
    }
}
