<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_fasilitas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdFasilitasController extends Controller
{
    public function index() {
        $data = M_fasilitas::select(
                'm_fasilitas.id_mfasilitas',
                (DB::raw('(CASE WHEN m_fasilitas.jenis_fasilitas = 1 THEN "Toilet" WHEN m_fasilitas.jenis_fasilitas = 2 THEN "Bola" WHEN m_fasilitas.jenis_fasilitas = 3 THEN "Rompi" WHEN m_fasilitas.jenis_fasilitas = 4 THEN "Area Parkir" ELSE "-" END) as title_fasilitas')),
                'm_fasilitas.desc_fasilitas'
            )
            ->get();

        return view('admin.fasilitas.index', compact('data'));
    }

    public function fasilitasCreatePage() {
        return view('admin.fasilitas.create');
    }

    public function fasilitasAdd(Request $request) {
        $validator = Validator::make($request->all(), [
            'jenis_fasilitas'     => 'required',
            'desc_fasilitas'      => 'required'
        ], [
            'jenis_fasilitas.required'    => 'Jenis Fasilitas tidak boleh kosong',
            'desc_fasilitas.required'     => 'Keterangan Fasilitas tidak boleh kosong'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            DB::transaction(function () use ($request) {
                // create fasilitas
                M_fasilitas::create([
                    'jenis_fasilitas'     => $request->jenis_fasilitas,
                    'desc_fasilitas'    => $request->desc_fasilitas
                ]);
            });

            return redirect()->route('fasilitas')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }

    public function fasilitasUpdatePage($id_fasilitas)
    {
        $update = M_fasilitas::where('m_fasilitas.id_mfasilitas', $id_fasilitas)
                    ->select('m_fasilitas.*')
                    ->first();
        return view('admin.fasilitas.edit', compact('update'));
    }

    public function fasilitasUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_fasilitas'     => 'required',
            'desc_fasilitas'      => 'required'
        ], [
            'jenis_fasilitas.required'    => 'Jenias Fasilitas tidak boleh kosong',
            'desc_fasilitas.required'     => 'Keterangan Fasilitas tidak boleh kosong'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            DB::transaction(function () use ($request) {
                M_fasilitas::where('id_mfasilitas', $request->id_mfasilitas)
                    ->update([
                        'jenis_fasilitas'      => $request->jenis_fasilitas,
                        'desc_fasilitas'    => $request->desc_fasilitas
                    ]);
            });

            return redirect()->route('fasilitas')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }

    public function fasilitasDelete($id_mfasilitas)
    {
        $delete = M_fasilitas::where('id_mfasilitas', $id_mfasilitas)->delete();

        if ($delete) {
            return redirect()->route('fasilitas')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('fasilitas')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
