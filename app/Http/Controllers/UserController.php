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
                'idRole' => 'numeric',
                'userName' => 'required|string|max:255',
                'password' => 'required|string|min:6', //123456
                'password' => 'required|confirmed', //se valida confirmacion de pass el campo enviado seria password_confirmation
            ]);
            $idRole = $validatedData['idRole'];
            $roleName = DB::table('roles')->select("name")->where("id","=", $idRole)
            ->first();
            var_dump($roleName->name);die;
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
}
