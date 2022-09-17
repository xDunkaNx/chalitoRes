<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            if (!Auth::attempt($request->only('userName','password'))) {
               return response()->json([
                    'message' => 'Usuario o contraseña incorrectos'
               ],401);
            }
                $user = User::where('userName',$request['userName'])->firstOrFail();
                $token = $user->createToken('authToken')->accessToken;
    
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Usuario logueado correctamente",
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function infoUser ()
    {
        try {
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'msg' => "Acerca del perfil de usuario",
                'data' => auth()->user(),
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function logOut ()
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'msg' => "Se cerro la sesion correctamente",
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
