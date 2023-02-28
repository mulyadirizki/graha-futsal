<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PePembayaranController extends Controller
{
    use MasterTrait;

    public function pembayarangAdd(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_tuser'      => 'required',
            'id_booking'   => 'required',
            'tgl_transaksi' => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'id_tuser.required'      => 'Silahkan Login untuk melakukan konfirmasi pembayaran',
            'id_booking.required'   => 'Booking tidak ditemukan',
            'tgl_transaksi.required' => 'Tanggal Pembayaran tidak boleh kosong',
            'image.required'         => 'Bukti Pembayaran tidak boleh kosong'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
            die();
        }

        $status = Pembayaran::where('id_tuser', $request->id_tuser)
            ->where('id_booking', $request->id_booking)
            ->first();

        if ($status != null) { //jika sudah terdaftar ditanggal yang sama
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan konfirmasi pembayaran',
            ], 422);
            die();
        }

        //create id
        $id_transaksi = $this->idCreate('t_transaksi', 'id_transaksi');
        $image = $this->uploadImage($request, $path = 'public/img/pembayaran/');
        $save = Pembayaran::create([
            'id_transaksi'      => $id_transaksi,
            'id_tuser'          => $request->id_tuser,
            'id_booking'        => $request->id_booking,
            'id_mtransaksi'     => $request->id_mtransaksi,
            'tgl_transaksi'     => $request->tgl_transaksi,
            'bukti_transaksi'   => $image->hashName(),
        ]);

        if ($save) {
            $data = Pembayaran::join('t_user', 't_transaksi.id_tuser', '=', 't_user.id_tuser')
                        ->join('m_booking', 't_transaksi.id_booking', '=', 'm_booking.id_booking')
                        ->select('t_transaksi.*', 't_user.nama', 'm_booking.*')
                        ->where('t_transaksi.id_transaksi', $id_transaksi)->first();

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
}
