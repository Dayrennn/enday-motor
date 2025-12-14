<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    // tampilkan halaman booking + data
    public function index()
    {
        $booking = Booking::with(['user', 'motor'])->get();
        return view('admin.booking', compact('booking'));
    }

    // update status booking
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }
}
