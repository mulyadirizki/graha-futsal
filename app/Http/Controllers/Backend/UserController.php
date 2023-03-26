<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\T_user;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\MasterTrait;

class UserController extends Controller
{
    use MasterTrait;

    public function getUserdmin()
    {
        $data = T_user::select('t_user.*', 'users.email', 'users.roles', (DB::raw("CONVERT(t_user.id_tuser, CHAR) as iduser")),
            (DB::raw('(CASE WHEN t_user.j_kel = 1 THEN "Laki - Laki" WHEN t_user.j_kel = 2 THEN "Perempuan" ELSE "-" END) as jkel')))
            ->leftJoin('users', 'users.id_tuser', '=', 't_user.id_tuser')
            ->orderBy('users.roles', 'ASC')
            ->get();
        return view('backend.users.index', compact('data'));
    }

    public function addUserAdmin()
    {
        return view('backend.users.create');
    }

    public function addUserAdminStore(Request $request)
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
                    'roles'         => $request->roles,
                    'id_tuser'      => $id_tuser
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Create data User berhasil'
            ]);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }

    public function upadteUserAdmin($id_tuser)
    {
        $user = T_user::where('t_user.id_tuser', $id_tuser)
            ->select('t_user.*', 'users.email', 'users.roles', (DB::raw("CONVERT(t_user.id_tuser, CHAR) as iduser")),
            (DB::raw('(CASE WHEN t_user.j_kel = 1 THEN "Laki - Laki" WHEN t_user.j_kel = 2 THEN "Perempuan" ELSE "-" END) as jkel')))
            ->leftJoin('users', 'users.id_tuser', '=', 't_user.id_tuser')
            ->first();
        return view('backend.users.edit', compact('user'));
    }

    public function upadteUserAdminStore(Request $request)
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
            'email'     => 'required|email',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            DB::transaction(function () use ($request) {
                // create tuser
                T_user::where('t_user.id_tuser', $request->id_tuser)
                    ->update([
                        'id_tuser'      => $request->id_tuser,
                        'nik'           => $request->nik,
                        'nama'          => strtoupper($request->nama),
                        'tgl_lahir'     => $request->tgl_lahir,
                        'j_kel'         => $request->j_kel,
                        'no_hp'         => $request->no_hp,
                        'pekerjaan'     => $request->pekerjaan,
                        'alamat'        => $request->alamat
                    ]);

                // create user
                User::where('users.id_tuser', $request->id_tuser)
                    ->update([
                        'email'         => $request->email,
                        'password'      => bcrypt($request->password),
                        'roles'         => $request->roles,
                        'id_tuser'      => $request->id_tuser
                    ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Update data User berhasil'
            ]);
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }

    public function deleteUserdmin($id_tuser)
    {
        $user = T_user::find($id_tuser);

        if($user) {
            $user->delete();
            return redirect()->route('getUserdmin')->with(['success' => 'Data Berhasil Dihapus!']);
        }else {
            return redirect()->route('getUserdmin')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
