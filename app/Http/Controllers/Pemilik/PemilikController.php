<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\T_user;
use App\Models\User;
use App\Models\Booking;
use App\Models\Pembayaran;

class PemilikController extends Controller
{
    public function pemilikPage()
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
        return view('pemilik.home', compact('user', 'booking', 'transaksi'));
    }

    public function pemilikPemainPage(Request $request)
    {
        $data = T_user::join('users', 't_user.id_tuser', '=', 'users.id_tuser')
            ->select('t_user.*', 'users.roles',
                (DB::raw('(CASE WHEN t_user.j_kel = 1 THEN "Laki - Laki" WHEN t_user.j_kel = 2 THEN "Perempuan" ELSE "-" END) as jkel')))
            ->where('users.roles', 3)
            ->get();

        $userName = auth()->user()->username;

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('pemilik.data.p_pemain', compact('data', 'userName'));
    }

    public function pemilikBookingPage(Request $request)
    {
        $data = Booking::join('t_user', 'm_booking.id_tuser', '=', 't_user.id_tuser')
                    ->join('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
                    ->leftJoin('t_transaksi', 't_transaksi.id_booking', '=', 'm_booking.id_booking')
                    ->select('m_booking.*', 't_user.nama', 'm_lapangan.dsc_lapangan', 'm_lapangan.harga_lapangan', 't_transaksi.id_transaksi',
                        (DB::raw('(CASE WHEN m_booking.status = 1 THEN "Segera Main" WHEN m_booking.status = 2 THEN "Sedang Main" WHEN m_booking.status = 3 THEN "Selesai" ELSE "-" END) as status_booking')),
                        (DB::raw('TIMEDIFF(m_booking.jam_berakhir, m_booking.jam_mulai) as diff')))
                    ->get();
        $userName = auth()->user()->username;

        if ($request->ajax()) {
            return response()->json($data);
        }
        return view('pemilik.data.p_booking', compact('data', 'userName'));
    }

    public function pemilikTransaksiPage(Request $request)
    {
        $data = Pembayaran::join('t_user', 't_transaksi.id_tuser', '=', 't_user.id_tuser')
                    ->join('m_transaksi', 't_transaksi.id_mtransaksi', '=', 'm_transaksi.id_mtransaksi')
                    ->select('t_transaksi.*', 't_user.nama', 'm_transaksi.jenis_bank', 't_user.nama', 'm_transaksi.no_rek')
                    ->get();

        $userName = auth()->user()->username;

        if ($request->ajax()) {
            return response()->json($data);
        }
        return view('pemilik.data.p_transaksi', compact('data', 'userName'));
    }
}
