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
    function getAllRoleForSupport () {
        try {
            $rols = Role::get();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'rols' => $rols
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllRole ($idUser)  {
        try {
            $allRole = Role::where("status", "=", self::STATUS_TRUE)->get();
            if($idUser > 0){
                /*
                 * NOTA
                 * Aqui se debe traer ordenado primero por el rol del usuario enviado.
                 */
            }
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'rols' => $allRole
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getRole (Request $request)  {
        try {
            $validatedData = $request->validate(['idRole' => 'required|numeric']);
            $allRole = Role::where("isActive", '=', self::STATUS_TRUE)->where("status", "=", self::STATUS_TRUE)->where("id", "=", $validatedData['idRole'])->first();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'rols' => $allRole
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function deleteRole (Request $request)  {
        try {
            $validatedData = $request->validate(['idRole' => 'required|numeric']);
            
            $role = Role::find($validatedData['idRole']);

            if(empty($role)){
                /* NOTA
                 * Aqui se debe validar que solo se elimine el Role siempre y cuando no existan Usuarios con ese Rol
                 * Pero no se como hacer dicha validacion.
                 * 
                */
                $category->status = SELF::IS_DEACTIVE;
                $category->save();

                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Role eliminado correctamente"
                ]);
            } else {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "No se encontro la categoria a desactivar"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function deactiveOrActiveRole (Request $request)  {
        try {
            $validatedData = $request->validate([
                'idRole' => 'required|numeric'
                ,'status' => 'required|boolean'
            ]);
            
            $role = Role::find($validatedData['idRole']);

            if(empty($role)){
                if ($validatedData["status"]) {
                    $role->isActive = SELF::IS_ACTIVE;
                    $role->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se activo el rol correctamente"
                    ]);
                }else{
                    $role->isActive = SELF::IS_DEACTIVE;
                    $role->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se desactivo el rol correctamente"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Id Rol no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
