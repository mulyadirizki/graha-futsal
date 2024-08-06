<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_user extends Model
{
    use HasFactory;

    protected $table = 't_user';

    protected $primaryKey = 'id_tuser';

    protected $fillable = [
        'id_tuser',
        'nama',
        'tgl_lahir',
        'j_kel',
        'no_hp',
        'email',
        'alamat'
    ];

    protected $casts = [
        'id_tuser' => 'string',
    ];
}
