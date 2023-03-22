<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        if($user = Auth::user()) {
            if($user->roles == '1'){
                return redirect()->intended('admin');
            }else if($user->roles == '2'){
                return redirect()->intended('user');
            }
        }
        return view('auth.login');
    }

    public function loginStore(Request $request) {
        //set validation
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user'    => Auth::user(),
        ], 200);
    }

    public function registrasiPage()
    {
        return view('auth.register');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return Redirect()->route('home');
    }
}
