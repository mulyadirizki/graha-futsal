<?php

namespace App\Http\Controllers\Backend;

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

    public function getMobilAdmin(Request $request)
    {
        $data = Mobil::all();
        return view('backend.mobil.index', compact('data'));
    }

    public function addMobil()
    {
        return view('backend.mobil.create');
    }

    public function addMobilStore(Request $request)
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

    public function deleteMobil($id_mobil)
    {
        $cars = Mobil::find($id_mobil);

        if($cars) {
            $cars->delete();
            Storage::disk('local')->delete('public/img/mobil/'. basename($cars->img_mobil));

            return redirect()->route('getMobilAdmin')->with(['success' => 'Data Berhasil Dihapus!']);
        }else {
            return redirect()->route('getMobilAdmin')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function upadteMobil($id_mobil)
    {
        $mobil = Mobil::where('id_mobil', $id_mobil)->first();
        return view('backend.mobil.edit', compact('mobil'));
    }

    public function upadteMobilStore(Request $request)
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

        $image = $this->uploadImage($request, $path = 'public/img/mobil/');
        if($cars = Mobil::find($request->id_mobil)) {
            Storage::disk('local')->delete('public/img/mobil/'. basename($cars->img_mobil));

            $save = Mobil::where('m_mobil.id_mobil', $request->id_mobil)
                ->update([
                    'id_mobil'      => $request->id_mobil,
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
                $data = Mobil::where('m_mobil.id_mobil', $request->id_mobil)
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
    }
}
