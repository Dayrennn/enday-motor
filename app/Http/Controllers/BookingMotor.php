<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Motor;
use App\Http\Controllers\Controller;

class BookingMotor extends Controller
{
    public function index()
    {
        // Ambil semua motor untuk dropdown edit booking
        $motors = Motor::all();

        if (auth()->user()->role === 'admin') {
            $booking = Booking::with(['user', 'motor'])->paginate(10);
            return view('admin.booking', compact('booking', 'motors'));
        } elseif (auth()->user()->role === 'pelanggan') {
            $booking = Booking::with(['user', 'motor'])
                ->where('user_id', auth()->id())
                ->paginate(10);
            return view('pelanggan.dashboard', compact('booking', 'motors'));
        } elseif (auth()->user()->role === 'sales') {
            $booking = Booking::with(['user', 'motor'])->paginate(10);
            return view('sales.booking', compact('booking', 'motors'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'motor_id' => 'required|exists:data_motor,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_booking' => 'required|date',
            'uang_muka' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        $motor = Motor::findOrFail($request->motor_id);

        Booking::create([
            'motor_id' => $motor->id,
            'user_id' => auth()->id(),
            'nama_motor' => $motor->nama_motor,
            'jumlah' => $request->jumlah,
            'tanggal_booking' => $request->tanggal_booking,
            'uang_muka' => $request->uang_muka,
            'catatan' => $request->catatan,
            'kode_booking' => $request->kode_booking,
            'status' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Booking motor berhasil dilakukan.');
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'motor_id' => 'required|exists:data_motor,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_booking' => 'required|date',
            'uang_muka' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        $motor = Motor::findOrFail($request->motor_id);

        $booking->update([
            'motor_id' => $motor->id,
            'nama_motor' => $motor->nama_motor,
            'jumlah' => $request->jumlah,
            'tanggal_booking' => $request->tanggal_booking,
            'uang_muka' => $request->uang_muka,
            'catatan' => $request->catatan,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Booking berhasil diperbarui.');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Booking berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Aktif,Batal',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        // Simpan file
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $booking->bukti_pembayaran = $path;
        $booking->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
