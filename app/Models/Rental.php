<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 't_rental';

    protected $primaryKey = 'id_rental';

    protected $fillable = [
        'id_rental',
        'id_tuser',
        'id_mobil',
        'tgl_rental',
        'tgl_kembali',
        'total_biaya',
        'cara_bayar',
        'status_rental',
    ];
}
