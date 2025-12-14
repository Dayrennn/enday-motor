<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
    use HasFactory;
    protected $table = 'booking';

    protected $fillable = [
        'kode_booking',
        'user_id',
        'motor_id',
        'nama_motor',
        'jumlah',
        'tanggal_booking',
        'uang_muka',
        'catatan',
        'bukti_pembayaran'
    ];
}
