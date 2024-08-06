<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_fasilitas extends Model
{
    use HasFactory;

    protected $table = 'm_fasilitas';

    protected $primaryKey = 'id_mfasilitas';

    protected $fillable = [
        'id_fasilitas',
        'jenis_fasilitas',
        'desc_fasilitas',
    ];
}
