<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        # code...
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:6',
        ]);

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;

        if ($validator->fails()) { 
            // validasi gagal
            $errors = $validator->errors();
            $message = $errors;

        }
        else{
            // validasi sukses
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => json_encode(['CUSTOMER']),
            ]);

            if ($user) {
                # code...
                $user->generateToken();
                $status = "success";
                $message = "register successfully";
                $data = $user->toArray();
                $code = 200;

            } else {

                $message = 'register failed';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request)
    {
        # code...
        $user = Auth::user();

        if ($user) {
            # code...
            $user->api_token = null;
            $user->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'logout berhasil',
            'data' => null
        ], 200);
    }
}
