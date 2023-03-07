<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Jobs\SendEmailJob;
use App\Models\Booking;

class PePembayaranController extends Controller
{
    use MasterTrait;

    public function pembayarangAdd(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_tuser'      => 'required',
            'id_booking'   => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'id_tuser.required'      => 'Silahkan Login untuk melakukan konfirmasi pembayaran',
            'id_booking.required'   => 'Booking tidak ditemukan',
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
        $tgl_transaksi = Carbon::now();

        $save = Pembayaran::create([
            'id_transaksi'      => $id_transaksi,
            'id_tuser'          => $request->id_tuser,
            'id_booking'        => $request->id_booking,
            'id_mtransaksi'     => $request->id_mtransaksi,
            'tgl_transaksi'     => $tgl_transaksi,
            'bukti_transaksi'   => $image->hashName(),
        ]);

        if ($save) {
            $dataPembayaran = Pembayaran::join('t_user', 't_transaksi.id_tuser', '=', 't_user.id_tuser')
                        ->join('m_booking', 't_transaksi.id_booking', '=', 'm_booking.id_booking')
                        ->select('t_transaksi.*', 't_user.*', 'm_booking.*')
                        ->where('t_transaksi.id_transaksi', $id_transaksi)->get();

            foreach($dataPembayaran as $value) {
                $send_email =[
                    'email'         => $value->email,
                    'tgl_transaksi' => $value->tgl_transaksi,
                    'nama'          => $value->nama,
                    'id_transaksi'  => $value->id_transaksi,
                    'no_hp'         => $value->no_hp,
                    'total_biaya'   => $value->total_biaya
                ];
            }
            dispatch(new SendEmailJob($send_email));
            return response()->json([
                'success'   => true,
                'email'     => $value->email,
                'message'   => 'Success to add data',
                'data'      => $dataPembayaran,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to add data',
        ], 422);
    }
}
