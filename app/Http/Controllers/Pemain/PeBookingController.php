<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lapangan;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PeBookingController extends Controller
{
    use MasterTrait;

    public function bookingAdd(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_lapangan'   => 'required',
            'tgl_booking'   => 'required',
            'jam_mulai'     => 'required',
            'jam_berakhir'  => 'required'
        ], [
            'id_lapangan.required'  => 'Lapangan tidak boleh kosong',
            'tgl_booking.required'  => 'Tanggal Booking tidak boleh kosong',
            'jam_mulai.required'    => 'Jam Mulai tidak boleh kosong',
            'jam_berakhir.required' => 'Jam Berakhir tidak boleh kosong'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
            die();
        }

        $status = Booking::where('id_tuser', $request->id_tuser)
            ->where('tgl_booking', $request->tgl_booking)
            ->where('jam_mulai', $request->jam_mulai)
            ->first();

        if ($status != null) { //jika sudah terdaftar ditanggal yang sama
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah Booking di tanggal dan jam yang sama',
            ], 422);
            die();
        }

        //create id
        $id_booking = $this->idCreate('m_booking', 'id_booking');
        $dt = Carbon::now();
        $startTime = Carbon::parse($request->jam_mulai);
        $endTime = Carbon::parse($request->jam_berakhir);

        $harga_lapangan = Lapangan::where('id_lapangan', $request->id_lapangan)->first();

        $totalDuration = ($endTime->diff($startTime)->format('%H')) * $harga_lapangan->harga_lapangan;

        $save = Booking::create([
            'id_booking'    => $id_booking,
            'id_tuser'      => Auth::user()->id_tuser,
            'id_lapangan'   => $request->id_lapangan,
            'tgl_booking'   => $request->tgl_booking,
            'jam_mulai'     => $request->jam_mulai,
            'jam_berakhir'  => $request->jam_berakhir,
            'status'        => 1,
            'total_biaya'   => $totalDuration
        ]);

        if ($save) {
            $data = Booking::join('t_user', 'm_booking.id_tuser', '=', 't_user.id_tuser')
                        ->join('m_lapangan', 'm_booking.id_lapangan', '=', 'm_lapangan.id_lapangan')
                        ->select('m_booking.*', 't_user.nama', 'm_lapangan.*')
                        ->where('m_booking.id_booking', $id_booking)->first();

            return response()->json([
                'success'   => true,
                'message'   => 'Success to add data',
                'data'      => $data,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to add data',
        ], 422);
    }

    public function bookingTimeFree(Request $request)
    {
        $data = Booking::select('m_booking.jam_mulai', 'm_booking.jam_berakhir')
                    ->where('tgl_booking', $request->tgl_booking)
                    ->get()
                    ->toArray();

        return response()->json([
            'success'   => true,
            'data'      => $data
        ]);
    }
}
