<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                // 'idGroup' => 'required|numeric',
                'userName' => 'required|string|max:255',
                'password' => 'required|string|min:6', //123456
                'password' => 'required|confirmed', //se valida confirmacion de pass el campo enviado seria password_confirmation
            ]);
        //     $group = Group::select('*')
        //     ->where('groups.id', $validatedData["idGroup"])
        //     ->first();
        // if ($group["id"] == null) {
        //     return response()->json([
        //         'status' => SELF::STATUS_FALSE,
        //         'msg' => "el ID del grupo no existe"
        //     ]);
        // }
            // if ($group["isActive"] == SELF::STATUS_FALSE || $group["status"] == SELF::STATUS_FALSE) {
            //     return response()->json([
            //         'status' => SELF::STATUS_FALSE,
            //         'msg' => "El grupo de usuario que intenta registrar se encuentra desactivado",
            //     ]);
            // }
           
            $user = User::create([
                // 'idGroup' => $group["id"],
                'userName' => $validatedData['userName'],
                'password' => Hash::make($validatedData['password'])
            ]);
            $token = $user->createToken('authToken')->accessToken;
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'msg' => "Registro de usuario exitoso",
                'access_token' => $token,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


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
