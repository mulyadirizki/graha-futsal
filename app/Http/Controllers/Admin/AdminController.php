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
                ->where('users.statusenabled', 1)
                ->count();
        $booking = Booking::join('t_user', 'm_booking.id_tuser', '=', 't_user.id_tuser')
                ->join('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
                ->count();
        $transaksi = Pembayaran::join('t_user', 't_transaksi.id_tuser', '=', 't_user.id_tuser')
                ->join('m_transaksi', 't_transaksi.id_mtransaksi', '=', 'm_transaksi.id_mtransaksi')
                ->count();
        return view('admin.home', compact('user', 'booking', 'transaksi'));
    }

    public function pemainAdminNew(Request $request) {
        $data = T_user::join('users', 't_user.id_tuser', '=', 'users.id_tuser')
            ->select('t_user.*', 'users.roles',
                (DB::raw('(CASE WHEN t_user.j_kel = 1 THEN "Laki - Laki" WHEN t_user.j_kel = 2 THEN "Perempuan" ELSE "-" END) as jkel')),
                (DB::raw('(CASE WHEN users.statusenabled = 0 THEN "Unverified" ELSE "-" END) as statusenabled'))
            )
            ->where('users.roles', 3)
            ->where('users.statusenabled', 0)
            ->get();

        $userName = auth()->user()->username;

        if ($request->ajax()) {
            return response()->json($data);
        }
        return view('admin.data.pemain-new', compact('data', 'userName'));
    }

    public function verifyUser($id) {
        try {
            $user = User::where('id_tuser', $id)->firstOrFail();
            $user->statusenabled = 1;
            $user->save();

            return response()->json(['success' => true, 'message' => 'User has been verified.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to verify user.']);
        }
    }

    public function pemainPage(Request $request)
    {
        $page       = (int)$request->get('page', 1); // Default ke halaman 1 jika tidak ada
        $limit      = (int)$request->get('limit', 10); // Default ke 10 item per halaman jika tidak ada
        $sort       = $request->get('sort', 'created_at'); // Default sorting berdasarkan 'created_at' jika tidak ada

        // Menangani sort dan memastikan kolom valid
        $column = preg_replace("/\W/", "", $sort);
        $asc    = substr($sort, 0, 1);
        $ascdsc = $asc === '+' ? 'ASC' : 'DESC';

        // Validasi kolom sorting
        $allowedColumns = ['id_tuser', 'nama', 'tgl_lahir', 'jkel', 'no_hp', 'email', 'alamat', 'formatted_created_at'];
        $column = in_array($column, $allowedColumns) ? $column : 'id_tuser';

        // Query data
        $data = T_user::join('users', 't_user.id_tuser', '=', 'users.id_tuser')
            ->select(
                't_user.*',
                'users.roles',
                DB::raw('(CASE WHEN t_user.j_kel = 1 THEN "Laki - Laki" WHEN t_user.j_kel = 2 THEN "Perempuan" ELSE "-" END) as jkel'),
                DB::raw('DATE_FORMAT(t_user.created_at, "%d-%m-%Y %H:%i") as formatted_created_at')
            )
            ->where('users.roles', 3)
            ->where('users.statusenabled', 1);

        // Filter berdasarkan tanggal booking
        if ($request->filled('created_at')) {
            $data->whereDate('t_user.created_at', '>=', $request->created_at);
        }

        if ($request->filled('created_atAkhir')) {
            $data->whereDate('t_user.created_at', '<=', $request->created_atAkhir);
        }

        // Paginasi
        $item = $data->orderBy($column, $ascdsc)
                    ->offset(($page - 1) * $limit)
                    ->limit($limit)
                    ->get();

        $userName = auth()->user()->username;

        if ($request->ajax()) {
            return response()->json($item);
        }

        return view('admin.data.pemain', compact('item', 'userName'));
    }


    public function bookingPage(Request $request)
    {
        $page       = (int)$request->get('page', 1); // Default ke halaman 1 jika tidak ada
        $limit      = (int)$request->get('limit', 10); // Default ke 10 item per halaman jika tidak ada
        $sort       = $request->get('sort', 'created_at'); // Default sorting berdasarkan 'created_at' jika tidak ada

        // Menangani sort dan memastikan kolom valid
        $column = preg_replace("/\W/", "", $sort);
        $asc    = substr($sort, 0, 1);
        $ascdsc = $asc === '+' ? 'ASC' : 'DESC';

        // Validasi kolom sorting
        $allowedColumns = ['id_booking', 'nama', 'dsc_lapangan', 'harga_lapangan', 'status_booking', 'diff', 'tgl_booking']; 
        $column = in_array($column, $allowedColumns) ? $column : 'id_booking';

        $data = Booking::join('t_user', 'm_booking.id_tuser', '=', 't_user.id_tuser')
            ->join('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
            ->leftJoin('t_transaksi', 't_transaksi.id_booking', '=', 'm_booking.id_booking')
            ->select(
                'm_booking.*',
                't_user.nama',
                'm_lapangan.dsc_lapangan',
                'm_lapangan.harga_lapangan',
                't_transaksi.id_transaksi',
                DB::raw('(CASE
                            WHEN m_booking.status = 1 THEN "Segera Main"
                            WHEN m_booking.status = 2 THEN "Sedang Main"
                            WHEN m_booking.status = 3 THEN "Selesai"
                            ELSE "-"
                        END) as status_booking'),
                DB::raw('TIMEDIFF(m_booking.jam_berakhir, m_booking.jam_mulai) as diff')
            );

        // Filter berdasarkan tanggal booking
        if ($request->filled('tgl_booking')) {
            $data->whereDate('m_booking.tgl_booking', '>=', $request->tgl_booking);
        }

        if ($request->filled('tgl_bookingAkhir')) {
            $data->whereDate('m_booking.tgl_booking', '<=', $request->tgl_bookingAkhir);
        }

        // Paginasi
        $item = $data->orderBy($column, $ascdsc)
                    ->offset(($page - 1) * $limit)
                    ->limit($limit)
                    ->get();

        $userName = auth()->user()->username;

        if ($request->ajax()) {
            return response()->json($item);
        }

        return view('admin.data.booking', compact('item', 'userName'));
    }

    public function transaksiPage(Request $request)
    {
        $page       = (int)$request->get('page', 1); // Default ke halaman 1 jika tidak ada
        $limit      = (int)$request->get('limit', 10); // Default ke 10 item per halaman jika tidak ada
        $sort       = $request->get('sort', 'created_at'); // Default sorting berdasarkan 'created_at' jika tidak ada

        // Menangani sort dan memastikan kolom valid
        $column = preg_replace("/\W/", "", $sort);
        $asc    = substr($sort, 0, 1);
        $ascdsc = $asc === '+' ? 'ASC' : 'DESC';

        // Validasi kolom sorting
        $allowedColumns = ['id_booking', 'nama', 'jenis_bank', 'no_rek', 'tgl_transaksi'];
        $column = in_array($column, $allowedColumns) ? $column : 'id_booking';

        $data = Pembayaran::join('t_user', 't_transaksi.id_tuser', '=', 't_user.id_tuser')
                    ->join('m_transaksi', 't_transaksi.id_mtransaksi', '=', 'm_transaksi.id_mtransaksi')
                    ->select('t_transaksi.*', 't_user.nama', 'm_transaksi.jenis_bank', 't_user.nama', 'm_transaksi.no_rek');

        $userName = auth()->user()->username;

        if ($request->filled('tgl_transaksi')) {
            $data->whereDate('t_transaksi.tgl_transaksi', '>=', $request->tgl_transaksi);
        }

        if ($request->filled('tgl_transaksiAkhir')) {
            $data->whereDate('t_transaksi.tgl_transaksi', '<=', $request->tgl_transaksiAkhir);
        }

        $item = $data->orderBy($column, $ascdsc)
                ->offset(($page - 1) * $limit)
                ->limit($limit)
                ->get();

        if ($request->ajax()) {
            return response()->json($item);
        }
        return view('admin.data.transaksi', compact('data', 'userName'));
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
