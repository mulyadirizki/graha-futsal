<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Fasilitas;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemainController extends Controller
{
    public function pemainPage()
    {
        return view('pemain.home');
    }

    public function pemainBooking()
    {
        $lapangan = Lapangan::select('m_lapangan.*')->get();
        return view('pemain.booking', compact('lapangan'));
    }
    // use for check schedule
    public function checkSchedule(Request $request)
    {
        $start = microtime(true);
        $id_lapangan = $request->post('id_lapangan');
        $tgl_booking = $request->post('tgl_booking');
        $get_data_booking = Booking::select('jam_mulai', 'jam_berakhir')->where('id_lapangan', $id_lapangan)->where('tgl_booking', $tgl_booking)->get();
        $mulai = $this->count_time('mulai', $get_data_booking);
        $selesai = $this->count_time('selesai', $get_data_booking);
        $data = [
            'status' => 'success',
            'time' => [
                'mulai' => $mulai['time_ready'],
                'selesai' => $selesai['time_ready'],
            ],
            'elapsed_time' => microtime(true) - $start,
        ];
        return response()->json($data, 200);
    }
    // use for count time
    public function count_time($type, $time_used)
    {
        $used = [];
        foreach ($time_used as $key => $value) {
            if ($type == 'mulai') {
                $used[] = (int) substr($value->jam_mulai, 0, 2);
            } else {
                $used[] = (int) substr($value->jam_berakhir, 0, 2);
            }
        }
        $time = [];
        $akhir = $type == 'mulai' ? 11 : 12;
        $start = $type == 'mulai' ? 1 : 2;
        for ($i = $start; $i <= $akhir; $i++) {
            $time_number = $i < 10 ? "0" . $i : $i;
            $time[] = $time_number . ':00:00';
        }
        sort($used);
        $count = count($used);
        $time_banding = [];
        if ($count > 0) {
            for ($i = $used[0]; $i <= $used[$count - 1]; $i++) {
                $time_number = $i < 10 ? "0" . $i : $i;
                $time_banding[] = $time_number . ':00:00';
            }
        }
        $time_ready = $time;
        if (count($time) > 0 && count($time_banding) > 0) {
            $time_ready = array_diff($time, $time_banding);
        }
        $data = [
            'time_ready' => $time_ready,
        ];
        return $data;
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
