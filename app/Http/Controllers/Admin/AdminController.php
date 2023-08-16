<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\T_user;
use App\Models\User;
use App\Models\Booking;
use App\Models\Fasilitas;
use App\Models\Pembayaran;

class AdminController extends Controller
{
    public function getAdminPage()
    {
        $user = DB::table('t_user')->join('users', 't_user.id_tuser', '=', 'users.id_tuser')
                ->where('users.roles', 3)
                ->count();
        $booking = Booking::join('t_user', 'm_booking.id_tuser', '=', 't_user.id_tuser')
                ->join('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
                ->count();
        $transaksi = Pembayaran::join('t_user', 't_transaksi.id_tuser', '=', 't_user.id_tuser')
                ->join('m_transaksi', 't_transaksi.id_mtransaksi', '=', 'm_transaksi.id_mtransaksi')
                ->count();
        return view('admin.home', compact('user', 'booking', 'transaksi'));
    }

    public function pemainPage()
    {
        $data = T_user::join('users', 't_user.id_tuser', '=', 'users.id_tuser')
            ->select('t_user.*', 'users.roles',
                (DB::raw('(CASE WHEN t_user.j_kel = 1 THEN "Laki - Laki" WHEN t_user.j_kel = 2 THEN "Perempuan" ELSE "-" END) as jkel')))
            ->where('users.roles', 3)
            ->get();
        return view('admin.data.pemain', compact('data'));
    }

    public function bookingPage()
    {
        $data = Booking::join('t_user', 'm_booking.id_tuser', '=', 't_user.id_tuser')
                    ->join('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
                    ->select('m_booking.*', 't_user.nama', 'm_lapangan.dsc_lapangan', 'm_lapangan.harga_lapangan',
                        (DB::raw('(CASE WHEN m_booking.status = 1 THEN "Segera Main" WHEN m_booking.status = 2 THEN "Sedang Main" WHEN m_booking.status = 3 THEN "Selesai" ELSE "-" END) as status_booking')),
                        (DB::raw('TIMEDIFF(m_booking.jam_berakhir, m_booking.jam_mulai) as diff')))
                    ->get();
        return view('admin.data.booking', compact('data'));
    }

    public function transaksiPage()
    {
        $data = Pembayaran::join('t_user', 't_transaksi.id_tuser', '=', 't_user.id_tuser')
                    ->join('m_transaksi', 't_transaksi.id_mtransaksi', '=', 'm_transaksi.id_mtransaksi')
                    ->select('t_transaksi.*', 't_user.nama', 'm_transaksi.jenis_bank', 't_user.nama', 'm_transaksi.no_rek')
                    ->get();
        return view('admin.data.transaksi', compact('data'));
    }

    public function bookingLapangan()
    {
        $data = Fasilitas::join('m_lapangan', 't_fasilitas.id_lapangan', '=', 'm_lapangan.id_lapangan')
                ->select('t_fasilitas.dsc_fasilitas', 'm_lapangan.*',
                    (DB::raw('(CASE WHEN m_lapangan.status_lapangan = 1 THEN "Ready" WHEN m_lapangan.status_lapangan = 2 THEN "Perbaikan" ELSE "-" END) as status_lap')))
                ->get();
        return view('admin.booking.home', compact('data'));
    }

    public function getCountDate(Request $request)
    {
        $data = Booking::select('m_booking.id_lapangan', 'm_booking.jam_mulai', 'm_booking.jam_berakhir')
            ->where('m_booking.tgl_booking', $request->tgl_booking)
            ->where('m_booking.id_lapangan', $request->id_lapangan)
            ->get();

        if ($data) {
            return response()->json([
                'success' => true,
                'data'    => $data
            ], 200);
        }
    }
}
