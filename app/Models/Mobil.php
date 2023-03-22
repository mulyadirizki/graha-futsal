<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'm_mobil';

    protected $primaryKey = 'id_mobil';

    protected $fillable = [
        'id_mobil',
        'nama_mobil',
        'no_pol',
        'warna',
        'th_mobil',
        'merk_mobil',
        'img_mobil',
        'harga_sewa',
        'denda_sewa',
        'status',
    ];
}
