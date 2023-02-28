<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'm_transaksi';

    protected $primaryKey = 'id_mtransaksi';

    protected $fillable = [
        'id_mtransaksi',
        'nama_rek',
        'no_rek',
        'jenis_bank'
    ];
}
