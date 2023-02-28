<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'm_booking';

    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_booking',
        'id_tuser',
        'id_lapangan',
        'tgl_booking',
        'jam_mulai',
        'jam_berakhir',
        'status',
        'total_biaya'
    ];
}
