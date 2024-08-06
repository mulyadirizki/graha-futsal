<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Fasilitas;
use App\Models\Lapangan;
use App\Models\Transaksi;
use App\Models\M_fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $tgl_booking = $request->post('tgl_booking');
        $lapangan = Lapangan::select('id_lapangan')->get();
        $schedule = [];
        if ($lapangan) {
            foreach ($lapangan as $key => $value) {
                $get_data_booking = Booking::select('jam_mulai', 'jam_berakhir')->where('id_lapangan', $value->id_lapangan)->where('tgl_booking', $tgl_booking)->get();
                $mulai = $this->count_time('mulai', $get_data_booking);
                $selesai = $this->count_time('selesai', $get_data_booking);
                $schedule[] = [
                    'id_lapangan' => $value->id_lapangan,
                    'time' => [
                        'mulai' => $mulai['time_ready'],
                        'selesai' => $selesai['time_ready'],
                    ],
                ];
            }
        }
        $data = [
            'status' => 'success',
            'schedule' => $schedule,
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

        $fasilitas = M_fasilitas::select('*')->get();
        // return response($data);exit;
        return view('pemain.booking', compact('data', 'fasilitas'));
    }

    public function pemainFasilitasDetail($id_mfasilitas) {
        $fasilitas = M_fasilitas::select(
                'm_fasilitas.id_mfasilitas',
                'm_fasilitas.jenis_fasilitas',
                (DB::raw('(CASE WHEN m_fasilitas.jenis_fasilitas = 1 THEN "Toilet" WHEN m_fasilitas.jenis_fasilitas = 2 THEN "Bola" WHEN m_fasilitas.jenis_fasilitas = 3 THEN "Rompi" WHEN m_fasilitas.jenis_fasilitas = 4 THEN "Area Parkir" ELSE "-" END) as title_fasilitas')),
                'm_fasilitas.desc_fasilitas'
            )
            ->where('m_fasilitas.id_mfasilitas', $id_mfasilitas)
            ->first();
        return view('pemain.fasilitas', compact('fasilitas'));
    }

    public function pemainBookingDate()
    {
        return view('pemain.bookingDate');
    }

    public function pemainPembayaranBooking()
    {
        $pembayaran = Booking::select('m_booking.*', 't_transaksi.id_transaksi', 'm_lapangan.dsc_lapangan')
            ->leftJoin('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
            ->leftJoin('t_transaksi', 't_transaksi.id_booking', '=', 'm_booking.id_booking')
            ->where('m_booking.id_tuser', Auth::user()->id_tuser)
            ->get();
        return view('pemain.pembayaran.index', compact('pembayaran'));
    }

    public function pemainPembayaranKonfirmasi($id_booking)
    {
        $dataBooking = Booking::select('m_booking.id_booking', 'm_booking.id_tuser', 'm_lapangan.dsc_lapangan', 'm_lapangan.tipe_lapangan', 'm_booking.tgl_booking',
                'm_booking.jam_mulai', 'm_booking.jam_berakhir', (DB::raw('TIMEDIFF(m_booking.jam_berakhir, m_booking.jam_mulai) as lama_main')), 'm_lapangan.harga_lapangan', 'm_booking.total_biaya')
            ->leftJoin('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
            ->where('m_booking.id_booking', $id_booking)
            ->first();
        $dataRekening = Transaksi::select('m_transaksi.*')->first();
        return view('pemain.pembayaran.konfirmasiPembayaran', compact('dataBooking', 'dataRekening'));
    }

    public function pemainPembayaranBukti($id_booking) {

        $dataBooking = Booking::select('m_booking.id_booking', 'm_booking.id_tuser', 'm_lapangan.dsc_lapangan', 'm_lapangan.tipe_lapangan', 'm_booking.tgl_booking',
                'm_booking.jam_mulai', 'm_booking.jam_berakhir', (DB::raw('TIMEDIFF(m_booking.jam_berakhir, m_booking.jam_mulai) as lama_main')), 'm_lapangan.harga_lapangan', 'm_booking.total_biaya')
            ->leftJoin('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
            ->where('m_booking.id_booking', $id_booking)
            ->first();
        $dataRekening = Transaksi::select('m_transaksi.*')->first();

        $dataTransaksi = DB::table('t_transaksi')->select('*')->where('t_transaksi.id_booking', $id_booking)->first();
        return view('pemain.pembayaran.buktiPembayaran', compact('dataBooking', 'dataRekening', 'dataTransaksi'));
    }
}
