<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 't_pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pembayaran',
        'id_tuser',
        'id_rental',
        'id_rek',
        'tgl_pembayaran',
        'bukti_transaksi',
    ];
}
