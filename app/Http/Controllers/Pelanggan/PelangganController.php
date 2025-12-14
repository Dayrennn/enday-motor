<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\Penjualan;
use App\Models\Booking;

class PelangganController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        return view('pelanggan.dashboard', [
            'motors' => Motor::all(),

            'booking' => Booking::where('user_id', $user->id)
                ->with(['user', 'motor'])
                ->latest()
                ->get(),

            'penjualan' => Penjualan::where('pelanggan_id', $user->id)
                ->with(['pelanggan', 'motor'])
                ->latest()
                ->paginate(5),
        ]);
    }
}
