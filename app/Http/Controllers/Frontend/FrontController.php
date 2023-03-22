<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Rental;
use App\Models\Pembayaran;
use App\Models\Rekening;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    use MasterTrait;

    public function index()
    {
        $data = Mobil::all();
        return view('welcome', compact('data'));
    }

    public function getHome()
    {
        $data = Mobil::all();
        return view('frontend.home', compact('data'));
    }

    public function getMobil()
    {
        $mobil = Mobil::orderBy('id_mobil', 'desc')->get();
        return view('frontend.mobil.mobil', compact('mobil'));
    }

    public function getMobilDetail($id_mobil)
    {
        $data = Mobil::where('id_mobil', $id_mobil)->first();

        $mobil = Mobil::orderBy('id_mobil', 'desc')->get()->take(4);
        return view('frontend.mobil.mobilDetail', compact('data', 'mobil'));
    }

    public function addMobilRental(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_mobil'    => 'required',
            'tgl_rental'  => 'required',
            'tgl_kembali' => 'required',
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
            'id_tuser'      => Auth::user()->id_tuser,
            'id_mobil'      => $request->id_mobil,
            'tgl_rental'    => $request->tgl_rental,
            'tgl_kembali'   => $request->tgl_kembali,
            'total_biaya'   => $total_bayar,
            'cara_bayar'    => $request->cara_bayar,
            'status_rental' => 1
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

    public function getDataRental()
    {
        $data = Rental::select('t_rental.*', 'm_mobil.*', 't_pembayaran.id_pembayaran',
            (DB::raw('DATEDIFF(t_rental.tgl_kembali, t_rental.tgl_rental) as lama_sewa')))
            ->leftJoin('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
            ->leftJoin('t_pembayaran', 't_pembayaran.id_rental', '=', 't_pembayaran.id_pembayaran')
            ->where('t_rental.id_tuser', Auth::user()->id_tuser)
            ->get();
        return view('frontend.pembayaran.rental', compact('data'));
    }

    public function pembyaranRental($id_rental)
    {
        $data = Rental::select('t_rental.*', 'm_mobil.*',
            (DB::raw('DATEDIFF(t_rental.tgl_kembali, t_rental.tgl_rental) as lama_sewa')))
            ->where('t_rental.id_rental', $id_rental)
            ->join('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
            ->first();
        $dataRekening = Rekening::select('m_rekening.*')->first();
        return view('frontend.pembayaran.index', compact('data', 'dataRekening'));
    }

    public function pembayarangAdd(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_tuser'      => 'required',
            'id_rental'     => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'id_tuser.required'      => 'Silahkan Login untuk melakukan konfirmasi pembayaran',
            'id_rental.required'     => 'Rental Mobil tidak ditemukan',
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
            ->where('id_rental', $request->id_rental)
            ->first();

        if ($status != null) { //jika sudah terdaftar ditanggal yang sama
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan konfirmasi pembayaran',
            ], 422);
            die();
        }

        //create id
        $id_pembayaran = $this->idCreate('t_pembayaran', 'id_pembayaran');
        $image = $this->uploadImage($request, $path = 'public/img/pembayaran/');
        $tgl_pembayaran = Carbon::now();

        $save = Pembayaran::create([
            'id_pembayaran'     => $id_pembayaran,
            'id_tuser'          => $request->id_tuser,
            'id_rental'         => $request->id_rental,
            'id_rek'            => $request->id_rek,
            'tgl_pembayaran'    => $tgl_pembayaran,
            'bukti_transaksi'   => $image->hashName(),
        ]);

        if ($save) {
            $dataPembayaran = Pembayaran::join('t_user', 't_pembayaran.id_tuser', '=', 't_user.id_tuser')
                        ->join('t_rental', 't_pembayaran.id_rental', '=', 't_rental.id_rental')
                        ->select('t_pembayaran.*', 't_user.*', 't_rental.*')
                        ->where('t_pembayaran.id_pembayaran', $id_pembayaran)->get();

            return response()->json([
                'success'   => true,
                'message'   => 'Konfirmasi pembayaran berhasil dilakukan',
                'data'      => $dataPembayaran,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Konfirmasi pembayaran gagal',
        ], 422);
    }
}
