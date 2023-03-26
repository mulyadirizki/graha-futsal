<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Rental;
use App\Models\T_user;
use App\Models\Rekembali;
use App\Models\Pembayaran;
use App\Models\Rekening;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\MasterTrait;

class MainController extends Controller
{
    use MasterTrait;

    public function index()
    {
        $user = DB::table('t_user')->join('users', 't_user.id_tuser', '=', 'users.id_tuser')
                ->where('users.roles', 2)
                ->count();
        $rental = Rental::all()
                ->count();
        return view('backend.home', compact('user', 'rental'));
    }

    public function getMobilRentaldmin()
    {
        $data = Rental::select('t_rental.*', 'm_mobil.*', 't_user.nama', 't_user.no_hp','t_pembayaran.id_pembayaran',
            (DB::raw('DATEDIFF(t_rental.tgl_kembali, t_rental.tgl_rental) as lama_sewa')))
            ->leftJoin('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
            ->leftJoin('t_user', 't_rental.id_tuser', '=', 't_user.id_tuser')
            ->leftJoin('t_pembayaran', 't_pembayaran.id_rental', '=', 't_pembayaran.id_pembayaran')
            ->get();
        return view('backend.data.rental', compact('data'));

    }

    public function addMobilRentaldmin()
    {
        $user = T_user::where('t_user.id_tuser', 2)->select('t_user.*', (DB::raw("CONVERT(t_user.id_tuser, CHAR) as iduser")))->get();
        $mobil = Mobil::all();
        return view('backend.data.createRental', compact('user', 'mobil'));
    }

    public function updateMobilRentaldmin($id_rental)
    {
        $user = Rental::select('t_rental.*', 'm_mobil.*', 't_user.nama', 't_user.no_hp','t_pembayaran.id_pembayaran',
            (DB::raw('DATEDIFF(t_rental.tgl_kembali, t_rental.tgl_rental) as lama_sewa')))
            ->leftJoin('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
            ->leftJoin('t_user', 't_rental.id_tuser', '=', 't_user.id_tuser')
            ->leftJoin('t_pembayaran', 't_pembayaran.id_rental', '=', 't_pembayaran.id_pembayaran')
            ->where('t_rental.id_rental', $id_rental)
            ->first();

        $mobil = Mobil::all();
        return view('backend.data.editRental', compact('user', 'mobil'));
    }

    public function addMobilRentaldminStore(Request $request)
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
            'id_tuser'      => $request->id_tuser,
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

    public function updateMobilRentaldminStore(Request $request)
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

        $harga_sewa = Mobil::where('id_mobil', $request->id_mobil)->first();
        $startTime = $request->tgl_rental;
        $endTime = $request->tgl_kembali;

        $diff  = abs(strtotime($endTime) - strtotime($startTime));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $total_bayar = $days * $harga_sewa->harga_sewa;

        $save = Rental::where('t_rental.id_rental', $request->id_rental)
            ->update([
                'id_rental'     => $request->id_rental,
                'id_tuser'      => $request->id_tuser,
                'id_mobil'      => $request->id_mobil,
                'tgl_rental'    => $request->tgl_rental,
                'tgl_kembali'   => $request->tgl_kembali,
                'total_biaya'   => $total_bayar,
                'cara_bayar'    => $request->cara_bayar,
                'status_rental' => 1
            ]);

        if ($save) {
            $data = Rental::where('t_rental.id_rental', $request->id_rental)
                ->leftJoin('t_user', 't_rental.id_tuser', '=', 't_user.id_tuser')
                ->leftJoin('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
                ->select('t_rental.*', 't_user.nama', 'm_mobil.*')
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Success update data',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed update data'
            ], 200);
        }
    }

    public function deleteMobilRentaldmin($id_rental)
    {
        $rental = Rental::find($id_rental);

        if($rental) {
            $rental->delete();
            return redirect()->route('getMobilRentaldmin')->with(['success' => 'Data Berhasil Dihapus!']);
        }else {
            return redirect()->route('getMobilRentaldmin')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    // rental kembali
    public function getRentalKembali(Request $request)
    {
        $data = Rental::select('t_rental.*', 'm_mobil.*', 't_user.nama', 't_user.no_hp',
        (DB::raw('DATEDIFF(t_rental.tgl_kembali, t_rental.tgl_rental) as lama_sewa')),
        (DB::raw('(CASE
                        WHEN CURDATE() > t_rental.tgl_kembali THEN "Expired tgl kembali"
                        WHEN CURDATE() = t_rental.tgl_kembali THEN "Hari ini dikembalikan"
                        ELSE "Belum Expired tgl Kembali" END) as tgl_expired')))
        ->leftJoin('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
        ->leftJoin('t_user', 't_rental.id_tuser', '=', 't_user.id_tuser')
        ->where('status_rental', 1)
        ->get();
        return view('backend.rental.index', compact('data'));
    }

    public function rentalKembaliStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_rental'      => 'required',
            'kondisi_mobil'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $id_ren_kemb = $this->idCreate('t_rental_kembali', 'id_ren_kemb');
            DB::transaction(function () use ($request, $id_ren_kemb) {
                // create tuser
                Rekembali::create([
                    'id_ren_kemb'    => $id_ren_kemb,
                    'id_rental'      => $request->id_rental,
                    'tgl_diterima'   => $request->tgl_diterima,
                    'kondisi_mobil'  => $request->kondisi_mobil
                ]);

                // create user
                Rental::where('id_rental', $request->id_rental)
                    ->update([
                        'status_rental' => 2
                    ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'success create data'
            ]);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }

        // $save = Rekembali::create([
        //     'id_ren_kemb'    => $id_ren_kemb,
        //     'id_rental'      => $request->id_rental,
        //     'tgl_diterima'   => $request->tgl_diterima,
        //     'kondisi_mobil'  => $request->kondisi_mobil
        // ]);

        // if ($save) {
        //     $data = Rekembali::where('t_rental_kembali.id_ren_kemb', $id_ren_kemb)
        //         ->select('t_rental_kembali.*')
        //         ->first();

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Success create data',
        //         'data'    => $data
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed create data'
        //     ], 200);
        // }
    }
    public function pembyaaranRental($id_rental)
    {
        $data = Rental::select('t_rental.*', 'm_mobil.*',
            (DB::raw('DATEDIFF(t_rental.tgl_kembali, t_rental.tgl_rental) as lama_sewa')))
            ->where('t_rental.id_rental', $id_rental)
            ->join('m_mobil', 't_rental.id_mobil', '=', 'm_mobil.id_mobil')
            ->first();
        $dataRekening = Rekening::select('m_rekening.*')->first();
        return view('backend.pembayaran.index', compact('data', 'dataRekening'));
    }

    public function bcpembayarangAdd(Request $request)
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
                'message' => 'Konsumen ini sudah melakukan konfirmasi pembayaran',
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
