<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                  'idRole' => 'required|numeric',
                'userName' => 'required|string|max:255',
                'password' => 'required|string|min:6', //123456
                'password' => 'required|confirmed', //se valida confirmacion de pass el campo enviado seria password_confirmation
            ]);
            $userNameSerarch = DB::table('users')->where("userName","=", $validatedData["userName"])->first();
            if ($userNameSerarch) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "el nombre del usuario ya existe"
                ]);
            }
            $idRole = $validatedData['idRole'];
            $roleName = DB::table('roles')->select("name")->where("id","=", $idRole)
            ->first();
            $user = User::create([
                'userName' => $validatedData['userName'],
                'password' => Hash::make($validatedData['password'])
            ])->assignRole($roleName->name);
            
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
    public function getAllUser(){
        try 
        {
            $users = DB::table('users')->select("id","userName","email")->get();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
