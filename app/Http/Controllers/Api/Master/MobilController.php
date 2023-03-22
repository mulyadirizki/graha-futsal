<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    use MasterTrait;

    public function getMobil()
    {
        $cars = Mobil::select('m_mobil.*')
                    ->get();

        return response()->json([
            'success'   => true,
            'data'      => $cars
        ], 200);
    }

    public function createMobil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mobil'    => 'required',
            'no_pol'        => 'required',
            'warna'         => 'required',
            'th_mobil'      => 'required',
            'merk_mobil'    => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga_sewa'    => 'required',
            'denda_sewa'    => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $id_mobil = $this->idCreate('m_mobil', 'id_mobil');
        $image = $this->uploadImage($request, $path = 'public/img/mobil/');
        $save = Mobil::create([
            'id_mobil'      => $id_mobil,
            'nama_mobil'    => strtoupper($request->nama_mobil),
            'no_pol'        => strtoupper($request->no_pol),
            'warna'         => ucwords($request->warna),
            'th_mobil'      => $request->th_mobil,
            'merk_mobil'    => ucwords($request->merk_mobil),
            'img_mobil'     => $image->hashName(),
            'harga_sewa'    => $request->harga_sewa,
            'denda_sewa'    => $request->denda_sewa,
            'status'        => 1,
        ]);

        if($save) {
            $data = Mobil::where('m_mobil.id_mobil', $id_mobil)
                ->select('m_mobil.*')
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data'    => $data
            ], 200);
        }

        return response()->json([
            'success'   => false,
            'message'   => 'Data gagal disimpan'
        ], 422);
    }

    public function updateMobil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mobil'    => 'required',
            'no_pol'        => 'required',
            'warna'         => 'required',
            'th_mobil'      => 'required',
            'merk_mobil'    => 'required',
            // 'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga_sewa'    => 'required',
            'denda_sewa'    => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $this->uploadImage($request, $path = 'public/img/mobil/');
        $update = Mobil::where('id_mobil', $request->id_mobil)
            ->update([
                'nama_mobil'    => strtoupper($request->nama_mobil),
                'no_pol'        => strtoupper($request->no_pol),
                'warna'         => ucwords($request->warna),
                'th_mobil'      => $request->th_mobil,
                'merk_mobil'    => ucwords($request->no_pol),
                // 'img_mobil'     => $image->hashName(),
                'harga_sewa'    => $request->harga_sewa,
                'denda_sewa'    => $request->denda_sewa,
                'status'        => 1,
            ]);

        if ($update) {
            $data = Mobil::where('id_mobil', $request->id_mobil)->first();
            return response()->json([
                'success'   => true,
                'message'   => 'Success update data',
                'data'      => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed update data',
            ], 422);
        }
    }

    public function deleteMobil($id_mobil)
    {
        $cars = Mobil::find($id_mobil);

        if($cars) {
            $cars->delete();
            Storage::disk('local')->delete('public/img/mobil/'. basename($cars->img_mobil));

            return response()->json([
                'success'   => true,
                'message'   => 'Data deleted successfully'
            ], 200);
        }else {
            return response()->json([
                'success'   => false,
                'message'   => 'Deleted Failed'
            ], 400);
        }
    }
}
