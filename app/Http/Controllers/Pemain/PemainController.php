<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Fasilitas;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class PemainController extends Controller
{
    public function pemainPage()
    {
        return view('pemain.home');
    }

    public function pemainBooking ()
    {
        $lapangan = Lapangan::select('m_lapangan.*')->get();
        return view('pemain.booking', compact('lapangan'));
    }

    public function pemainBookingDetail()
    {
        $data = Fasilitas::join('m_lapangan', 't_fasilitas.id_lapangan', '=', 'm_lapangan.id_lapangan')
                    ->select('t_fasilitas.dsc_fasilitas', 'm_lapangan.*',
                        (DB::raw('(CASE WHEN m_lapangan.status_lapangan = 1 THEN "Ready" WHEN m_lapangan.status_lapangan = 2 THEN "Perbaikan" ELSE "-" END) as status_lap')))
                    ->get();
        return view('pemain.detailBooking', compact('data'));
    }

    public function pemainBookingDate()
    {
        return view('pemain.bookingDate');
    }

    public function pemainPembayaran()
    {
        return view('pemain.pembayaran');
    }
}
