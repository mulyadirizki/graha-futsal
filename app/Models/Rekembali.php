<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekembali extends Model
{
    use HasFactory;

    protected $table = 't_rental_kembali';

    protected $primaryKey = 'id_ren_kemb';

    protected $fillable = [
        'id_ren_kemb',
        'id_rental',
        'tgl_diterima',
        'kondisi_mobil'
    ];
}
