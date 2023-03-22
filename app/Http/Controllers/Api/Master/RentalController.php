<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Mobil;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RentalController extends Controller
{
    use MasterTrait;

    public function rentalAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_mobil'    => 'required',
            'tgl_rental'  => 'required',
            'tgl_kembali' => 'required',
            'total_biaya' => 'required',
            'cara_bayar'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $id_rental = $this->idCreate('t_rental', 'id_rental');

        $harga_sewa = Mobil::where('id_mobil', $request->id_mobil)->first();
        $startTime = $request->tgl_rental;
        $endTime = $request->tgl_kembali;

        $diff  = abs(strtotime($endTime) - strtotime($startTime));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $total_bayar = $days * $harga_sewa->harga_sewa;

        $save = Rental::create([
            'id_rental'     => $id_rental,
            'id_tuser'      => auth()->guard('api')->user()->id_tuser,
            'id_mobil'      => $request->id_mobil,
            'tgl_rental'    => $request->tgl_rental,
            'tgl_kembali'   => $request->tgl_kembali,
            'total_biaya'   => $total_bayar,
            'cara_bayar'    => $request->cara_bayar
        ]);

        if ($save) {
            $data = Rental::where('t_rental.id_rental', $id_rental)
                ->leftJoin('t_user', 't_rental.id_tuser', '=', 't_user.id_tuser')
                ->leftJoin('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
                ->select('t_rental.*', 't_user.nama', 'm_mobil.*')
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Success create data',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed create data'
            ], 200);
        }
    }
}
