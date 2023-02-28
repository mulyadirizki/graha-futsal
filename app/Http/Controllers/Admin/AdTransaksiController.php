<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\MasterTrait;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdTransaksiController extends Controller
{
    use MasterTrait;

    public function index()
    {
        $data = Transaksi::select('m_transaksi.*')
            ->get();
        return view('admin.rekening.index', compact('data'));
    }

    public function rekeningCreatePage()
    {
        return view('admin.rekening.create');
    }

    public function transaksiAdd(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_rek'      => 'required',
            'no_rek'        => 'required',
            'jenis_bank'    => 'required'
        ], [
            'nama_rek.required'    => 'Nama Pemilik Rekening tidak boleh kosong',
            'no_rek.required'      => 'No Rekening tidak boleh kosong',
            'jenis_bank.required'  => 'Nama Bank tidak boleh kosong'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
            die();
        }

        //create id
        $id_mtransaksi = $this->idCreate('m_transaksi', 'id_mtransaksi');

        $save = Transaksi::create([
            'id_mtransaksi' => $id_mtransaksi,
            'nama_rek'      => strtoupper($request->nama_rek),
            'no_rek'        => $request->no_rek,
            'jenis_bank'    => strtoupper($request->jenis_bank)
        ]);

        if ($save) {
            return redirect()->route('rekening')->with(['success' => 'Data Berhasil Disimpan!']);
        }else {
            return redirect()->route('rekening')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function rekeningUpdatePage($id_mtransaksi)
    {
        $update = Transaksi::where('m_transaksi.id_mtransaksi', $id_mtransaksi)
                    ->select('m_transaksi.*')
                    ->first();
        return view('admin.rekening.edit', compact('update'));
    }

    public function transaksiUpdate(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_rek'      => 'required',
            'no_rek'        => 'required',
            'jenis_bank'    => 'required'
        ], [
            'nama_rek.required'    => 'Nama Pemilik Rekening tidak boleh kosong',
            'no_rek.required'      => 'No Rekening tidak boleh kosong',
            'jenis_bank.required'  => 'Nama Bank tidak boleh kosong'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
            die();
        }

        $update = Transaksi::where('id_mtransaksi', $request->id_mtransaksi)
            ->update([
                'id_mtransaksi' => $request->id_mtransaksi,
                'nama_rek'      => $request->nama_rek,
                'no_rek'        => $request->no_rek,
                'jenis_bank'    => $request->jenis_bank
            ]);

        if ($update) {
            return redirect()->route('rekening')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('rekening')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function transaksiDelete($id_mtransaksi)
    {
        $delete = Transaksi::where('id_mtransaksi', $id_mtransaksi)->delete();

        if ($delete) {
            return redirect()->route('rekening')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('rekening')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
