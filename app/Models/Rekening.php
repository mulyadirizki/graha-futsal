<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $table = 'm_rekening';

    protected $primaryKey = 'id_rek';

    protected $fillable = [
        'id_rek',
        'nama_rek',
        'no_rek',
        'jenis_bank',
    ];
}
