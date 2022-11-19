<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    function createOrUpdateOffice (Request $request) {
        try {
            if ($request["idoffice"] == null) {
                $office = new Office;
                $office->officeName = $request["officeName"];
                $office->isActive = 1; 
                $office->status = 1;
                $respuesta = $office->save();
                return $respuesta;
            }
            else {
                $office = Office::find($request["idoffice"]);
                $office->officeName = $request["officeName"];
                $respuesta = $office->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllOfficeForSupport ()  {
        try {
            $allOffice = Office::get();
            
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'offices' => $allOffice
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllOffice ($idUser)  {
        try {
            $allOffice = Office::where("status", '=', self::STATUS_TRUE)->get();
            
            if($idUser > 0) {
                $user = User::find($idUser);
                if(isset($user)) {
                    // Ordenar el array $allOffice
                    // Confirmar con Luis porque no podria setear sin necesidad de ordenar?
                } else {
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Usuario no registrado"
                    ]);
                }
            }
            
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'offices' => $allOffice
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getOffice (Request $request)  {
        try {
            $validatedData = $request->validate([
                'idOffice' => 'required|numeric'
            ]);

            $allOffice = Office::where("isActive", '=', self::STATUS_TRUE)->where("status", '=', self::STATUS_TRUE)->where("idOffice", "=", $validatedData['idOffice'])->firts();
            
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'offices' => $allOffice
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function deleteOffice(Request $request){
        try {
            $validatedData = $request->validate([
                'idOffice' => 'required|numeric'
            ]);

            $office = Office::find($request["idOffice"]);
            if (isset($office)) {
                $office->status = SELF::IS_DEACTIVE;
                $office->save();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Oficina eliminada correctamente"
                ]);
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Id de oficina no encontrada"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function deactiveOrActiveOffice(Request $request){
        try {
            $validatedData = $request->validate([
                'idOffice' => 'required|numeric'
                ,'status' => 'required|boolean'
            ]);

            $office = Office::find($validatedData["idOffice"]);
            if (isset($office)) {
                if ($validatedData["status"]) {
                    $office->isActive = SELF::IS_ACTIVE;
                    $office->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se activo la oficina correctamente"
                    ]);
                }else{
                    $office->isActive = SELF::IS_DEACTIVE;
                    $office->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se desactivo la oficina correctamente"
                    ]);
                }
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "oficina no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
