<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;
    protected $table = 'data_motor';

    protected $fillable = [
        'nama_motor',
        'merk_motor',
        'images',
        'caption',
        'spesifikasi',
        'description',
        'harga_awal',
        'diskon',
        'harga_setelah_diskon'
    ];
}
