<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createRole (Request $request) {
        try {
            $userNameSerarch = DB::table('roles')->where("name","=", $request["name"])->first();
            if (isset($userNameSerarch)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "el nombre del rol ya existe"
                ]);

            Role::create(["name" => $request["name"]]);
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'msg' => "Se a creado el rol correctamente",
            ]);
        }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function assigPermissionToRole () {
        
    }
    public function assigRoleToUser (Request $request) {
        try {
            $user = DB::table('users')->where("id","=", $request["idUser"])->first();
            $role = DB::table('roles')->where("id","=", $request["idRole"])->first();
            $queryResponse = DB::table('model_has_roles')->where('model_id', $user->id)
            ->update(['role_id' => $role->id]);
            if ($queryResponse) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Se asigno correctamente el rol ". $request->roleName . " al usuario " . $user->userName
                ]);
            }
            else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "el usuario ya tiene el rol que esta tratando de asignar"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllRoleForSupport (Request $request) {
        try {
            if ($request["idUser"] == 0) {
                $rols = Role::get();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'rols' => $rols
                ]);
            }else {
                var_dump("devolver roles ordenandos donde primero seria el rol del idUser recibido");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllRole ()  {
        try {
            $allRole = Role::where("status", "=", self::STATUS_TRUE)->get();
            return $allRole;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getRole (Request $request)  {
        try {
            $validatedData = $request->validate(['idRole' => 'required|numeric']);
            $allRole = Role::where("isActive", '=', self::STATUS_TRUE)->and_where("status", "=", self::STATUS_TRUE)->and_where("id", "=", $validatedData['idRole'])->get();
            return $allRole;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
