<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 't_transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_tuser',
        'id_booking',
        'id_mtransaksi',
        'tgl_transaksi',
        'bukti_transaksi'
    ];
}
