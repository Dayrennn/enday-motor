<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\User;
use App\Models\Contact;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Penjualan
        $totalPenjualan = Penjualan::whereIn('status', ['dp', 'diproses', 'selesai'])
            ->get()
            ->sum(function ($p) {
                if ($p->status == 'dp') {
                    // hanya 20% dari harga motor
                    return $p->total * 0.2;
                }
                return $p->total; // di proses dan selesai full harga
            });
        $totalPenjualanFormatted = number_format($totalPenjualan, 0, ',', '.');

        // Total Unit Terjual
        $totalUnitTerjual = Penjualan::whereIn('status', ['diproses', 'selesai'])
            ->sum('jumlah'); // uang dp masuk, unit tidak dihitung

        // Jumlah Pelanggan
        $jumlahPelanggan = User::where('role', 'pelanggan')->count();

        // Pesan Masuk
        $pesanMasuk = Contact::where('status', '!=', 'dibaca')->count();

        // Kirim semua variabel ke view
        return view('admin.dashboard', compact(
            'totalPenjualanFormatted',
            'totalUnitTerjual',
            'jumlahPelanggan',
            'pesanMasuk'
        ));
    }

    public function chartData()
    {
        $labels = [];
        $unitData = [];
        $revenueData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');

            $totalUnit = Penjualan::whereMonth('tanggal', $month->month)
                ->whereYear('tanggal', $month->year)
                ->sum('jumlah');

            $totalRevenue = Penjualan::whereMonth('tanggal', $month->month)
                ->whereYear('tanggal', $month->year)
                ->sum('total');

            $unitData[] = $totalUnit;
            $revenueData[] = round($totalRevenue / 1000000); // dalam juta
        }

        return response()->json([
            'labels' => $labels,
            'unitData' => $unitData,
            'revenueData' => $revenueData,
        ]);
    }
}
