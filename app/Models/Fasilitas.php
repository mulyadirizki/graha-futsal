<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 't_fasilitas';

    protected $primaryKey = 'id_fasilitas';

    protected $fillable = [
        'id_fasilitas',
        'id_lapangan',
        'dsc_fasilitas'
    ];
}
