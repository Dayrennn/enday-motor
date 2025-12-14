<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'pelanggan_id',
        'motor_id',
        'jumlah',
        'total',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id');
    }
}
