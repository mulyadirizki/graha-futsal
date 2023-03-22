<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekening;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Storage;

class RekeningController extends Controller
{
    use MasterTrait;

    public function getRekeningAdmin()
    {
        $data = Rekening::all();
        return view('backend.rekening.index', compact('data'));
    }

    public function addRekening()
    {
        return view('backend.rekening.create');
    }

    public function addRekeningStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rek'      => 'required',
            'no_rek'        => 'required',
            'jenis_bank'    => 'required'
        ],[
            'nama_rek.required' => 'Nama Pemilik Bank tidak boleh kosong',
            'no_rek.required' => 'No Rekening Bank tidak boleh kosong',
            'jenis_bank.required' => 'Nama Bank tidak boleh kosong',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $id_rek = $this->idCreate('m_rekening', 'id_rek');
        $save = Rekening::create([
            'id_rek'        => $id_rek,
            'nama_rek'      => strtoupper($request->nama_rek),
            'no_rek'        => $request->no_rek,
            'jenis_bank'    => strtoupper($request->jenis_bank),
        ]);

        if($save) {
            $data = Rekening::where('m_rekening.id_rek', $id_rek)
                ->select('m_rekening.*')
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

    public function upadteRekening($id_rek)
    {
        $rekening = Rekening::where('id_rek', $id_rek)->first();
        return view('backend.rekening.edit', compact('rekening'));
    }

    public function upadteRekeningStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rek'      => 'required',
            'no_rek'        => 'required',
            'jenis_bank'    => 'required'
        ],[
            'nama_rek.required' => 'Nama Pemilik Bank tidak boleh kosong',
            'no_rek.required' => 'No Rekening Bank tidak boleh kosong',
            'jenis_bank.required' => 'Nama Bank tidak boleh kosong',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $save = Rekening::where('id_rek', $request->id_rek)
            ->update([
                'id_rek'        => $request->id_rek,
                'nama_rek'      => strtoupper($request->nama_rek),
                'no_rek'        => $request->no_rek,
                'jenis_bank'    => strtoupper($request->jenis_bank),
            ]);

        if($save) {
            $data = Rekening::where('m_rekening.id_rek', $request->id_rek)
                ->select('m_rekening.*')
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

    public function deleteRekening($id_rek)
    {
        $cars = Rekening::find($id_rek);

        if($cars) {
            $cars->delete();
            return redirect()->route('getRekeningAdmin')->with(['success' => 'Data Berhasil Dihapus!']);
        }else {
            return redirect()->route('getRekeningAdmin')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
