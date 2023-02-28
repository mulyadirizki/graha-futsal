<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Fasilitas;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdLapanganController extends Controller
{
    use MasterTrait;

    public function index()
    {
        // $data = Lapangan::join('t_fasilitas', 'm_lapangan.id_lapangan', '=', 't_fasilitas.id_lapangan')
        //     ->select('m_lapangan.*',
        //         (DB::raw('(CASE WHEN m_lapangan.status_lapangan = 1 THEN "Ready" WHEN m_lapangan.status_lapangan = 2 THEN "Perbaikan" ELSE "-" END) as status_lap')))
        //     ->get();
        $data = Fasilitas::join('m_lapangan', 't_fasilitas.id_lapangan', '=', 'm_lapangan.id_lapangan')
                    ->select('t_fasilitas.dsc_fasilitas', 'm_lapangan.*',
                        (DB::raw('(CASE WHEN m_lapangan.status_lapangan = 1 THEN "Ready" WHEN m_lapangan.status_lapangan = 2 THEN "Perbaikan" ELSE "-" END) as status_lap')))
                    ->get();
        return view('admin.lapangan.index', compact('data'));
    }

    public function lapanganCreatePage()
    {
        return view('admin.lapangan.create');
    }

    public function lapanganAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_lapangan'     => 'required',
            'dsc_lapangan'       => 'required',
            'tipe_lapangan'     => 'required',
            'jam_buka'          => 'required',
            'jam_tutup'         => 'required',
            'status_lapangan'    => 'required',
            'harga_lapangan'    => 'required',
            'dsc_fasilitas'      => 'required'
        ], [
            'kode_lapangan.required'    => 'Kode Lapangan tidak boleh kosong',
            'dsc_lapangan.required'      => 'Nama Lapangan tidak boleh kosong',
            'tipe_lapangan.required'    => 'Tipe Lapangan tidak boleh kosong',
            'jam_buka.required'         => 'Jam Buka tidak boleh kosong',
            'jam_tutup.required'        => 'Jam Tutup tidak boleh kosong',
            'status_lapangan.required'   => 'Status Lapangan tidak boleh kosong',
            'harga_lapangan.required'   => 'Harga Lapangan tidak boleh kosong',
            'dsc_fasilitas.required'     => 'Fasilitas tidak boleh kosong'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $id_lapangan = $this->idCreate('m_lapangan', 'id_lapangan');
            $id_fasilitas = $this->idFasilitas();
            DB::transaction(function () use ($request, $id_lapangan, $id_fasilitas) {
                // create lapangan
                Lapangan::create([
                    'id_lapangan'      => $id_lapangan,
                    'kode_lapangan'    => $request->kode_lapangan ,
                    'dsc_lapangan'     => strtoupper($request->dsc_lapangan),
                    'tipe_lapangan'    => $request->tipe_lapangan,
                    'jam_buka'         => $request->jam_buka,
                    'jam_tutup'        => $request->jam_tutup,
                    'status_lapangan'  => $request->status_lapangan,
                    'harga_lapangan'   => $request->harga_lapangan
                ]);

                // create fasilitas
                Fasilitas::create([
                    'id_fasilitas'     => $id_fasilitas,
                    'id_lapangan'      => $id_lapangan,
                    'dsc_fasilitas'    => $request->dsc_fasilitas
                ]);
            });

            return redirect()->route('lapangan')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }

    public function lapanganUpdatePage($id_lapangan)
    {
        // $update = Lapangan::join('t_fasilitas', 'm_lapangan.id_lapangan', '=', 't_fasilitas.id_lapangan')
        //             ->where('m_lapangan.id_lapangan', $id_lapangan)
        //             ->select('m_lapangan.*', 't_fasilitas.dsc_fasilitas')->first();
        $update = Fasilitas::join('m_lapangan', 't_fasilitas.id_lapangan', '=', 'm_lapangan.id_lapangan')
                    ->where('m_lapangan.id_lapangan', $id_lapangan)
                    ->select('t_fasilitas.*', 'm_lapangan.*')
                    ->first();
        return view('admin.lapangan.edit', compact('update'));
    }

    public function lapanganUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_lapangan'     => 'required',
            'dsc_lapangan'       => 'required',
            'tipe_lapangan'     => 'required',
            'jam_buka'          => 'required',
            'jam_tutup'         => 'required',
            'status_lapangan'    => 'required',
            'harga_lapangan'    => 'required',
            'dsc_fasilitas'      => 'required'
        ], [
            'kode_lapangan.required'    => 'Kode Lapangan tidak boleh kosong',
            'dsc_lapangan.required'      => 'Nama Lapangan tidak boleh kosong',
            'tipe_lapangan.required'    => 'Tipe Lapangan tidak boleh kosong',
            'jam_buka.required'         => 'Jam Buka tidak boleh kosong',
            'jam_tutup.required'        => 'Jam Tutup tidak boleh kosong',
            'status_lapangan.required'   => 'Status Lapangan tidak boleh kosong',
            'harga_lapangan.required'   => 'Harga Lapangan tidak boleh kosong',
            'dsc_fasilitas.required'     => 'Fasilitas tidak boleh kosong'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            DB::transaction(function () use ($request) {
                // update tuser
                Lapangan::where('id_lapangan', $request->id_lapangan)
                    ->update([
                        'id_lapangan'      => $request->id_lapangan,
                        'kode_lapangan'    => $request->kode_lapangan ,
                        'dsc_lapangan'     => strtoupper($request->dsc_lapangan),
                        'tipe_lapangan'    => $request->tipe_lapangan,
                        'jam_buka'         => $request->jam_buka,
                        'jam_tutup'        => $request->jam_tutup,
                        'status_lapangan'  => $request->status_lapangan,
                        'harga_lapangan'   => $request->harga_lapangan
                    ]);

                // update user
                Fasilitas::where('id_lapangan', $request->id_lapangan)
                    ->update([
                        'id_lapangan'      => $request->id_lapangan,
                        'dsc_fasilitas'    => $request->dsc_fasilitas
                    ]);
            });

            return redirect()->route('lapangan')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }

    public function lapanganDelete($id_lapangan)
    {
        $delete = Lapangan::where('id_lapangan', $id_lapangan)->delete();

        if ($delete) {
            return redirect()->route('lapangan')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('lapangan')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
