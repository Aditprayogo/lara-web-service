<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        # code...
        $user = User::where('email', '=', $request->email)->firstOrFail();
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;

        if ($user) {
            # code...
            if (Hash::check($request->password, $user->password)) {
                # code...
                $user->generateToken();
                $status = 'success';
                $message = 'Login Success';
                $data = $user->toArray();
                // 200 berarti user success
                $code = 200;

            } else {
                # code...
                $message = 'Login Gagal, username salah';
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data

            ], $code);
            

        } 
        
    }

    public function register(Request $request)
    {
        # code...
    }

    public function logout(Request $request)
    {
        # code...
    }
}
