<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\T_user;
use App\Traits\MasterTrait;

class RegisterController extends Controller
{
    use MasterTrait;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nik'       => 'required',
            'nama'      => 'required',
            'tgl_lahir' => 'required',
            'j_kel'     => 'required',
            'no_hp'     => 'required',
            'pekerjaan' => 'required',
            'alamat'    => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $id_tuser = $this->idTuser();
            DB::transaction(function () use ($request, $id_tuser) {
                // create tuser
                T_user::create([
                    'id_tuser'      => $id_tuser,
                    'nik'           => $request->nik,
                    'nama'          => strtoupper($request->nama),
                    'tgl_lahir'     => $request->tgl_lahir,
                    'j_kel'         => $request->j_kel,
                    'no_hp'         => $request->no_hp,
                    'pekerjaan'     => $request->pekerjaan,
                    'alamat'        => $request->alamat
                ]);

                // create user
                User::create([
                    'email'         => $request->email,
                    'password'      => bcrypt($request->password),
                    'roles'         => 1,
                    'id_tuser'      => $id_tuser
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil'
            ]);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }
}
