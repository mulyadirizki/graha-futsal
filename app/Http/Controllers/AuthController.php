<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\T_user;
use App\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use MasterTrait;

    public function registerStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'tgl_lahir' => 'required',
            'j_kel'     => 'required',
            'no_hp'     => 'required',
            'email'     => 'required',
            'alamat'    => 'required',
            'username'  => 'required|unique:users',
            'password'  => 'required',
            'roles'     => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $id_tuser = $this->idTuser();
            DB::transaction(function () use ($request, $id_tuser) {
                // create tuser
                T_user::create([
                    'id_tuser'      => $id_tuser,
                    'nama'          => strtoupper($request->nama),
                    'tgl_lahir'     => $request->tgl_lahir,
                    'j_kel'         => $request->j_kel,
                    'no_hp'         => $request->no_hp,
                    'email'         => $request->email,
                    'alamat'        => $request->alamat
                ]);

                // create user
                User::create([
                    'username'      => $request->username,
                    'password'      => bcrypt($request->password),
                    'roles'         => $request->roles,
                    'id_tuser'      => $id_tuser
                ]);
            });
            // return response

            return redirect()->route('login');
        }catch (\Exception $e) {
            //return JSON process insert failed
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 422);
        }
    }

    public function loginPage()
    {
        if($user = Auth::user()) {
            if($user->roles == '1'){
                return redirect()->intended('pemilik');
            }else if($user->roles == '2'){
                return redirect()->intended('admin');
            }else if($user->roles == '3'){
                return redirect()->route('pemain');
            }
        }

        return view('login');
    }

    public function loginStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)) {
            if(auth()->user()->roles === 1) {
                return redirect('pemilik');
            } else if(auth()->user()->roles === 2) {
                return redirect('admin');
            } else if (auth()->user()->roles === 3) {
                return redirect()->route('pemain');
            } else {
                return response()->json([
                    'message' => 'Akses Denied'
                ]);
            }
        }

        // return redirect()->route('login')
        // ->withInput()
        // ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
    }

    public function registerPage()
    {
        return view('registrasi');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
