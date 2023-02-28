<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'm_lapangan';

    protected $primaryKey = 'id_lapangan';

    protected $fillable = [
        'id_lapangan',
        'kode_lapangan',
        'dsc_lapangan',
        'tipe_lapangan',
        'jam_buka',
        'jam_tutup',
        'status_lapangan',
        'harga_lapangan'
    ];
}
