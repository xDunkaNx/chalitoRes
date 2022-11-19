<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function createOrUpdateTable (Request $request) {
        try {
            if ($request["idTable"] == null) {

                $masiveCreate = array_key_exists('masiveCreate', $request) ? $request['masiveCreate'] : false;
                if(!$masiveCreate) {
                    $validatedData = $request->validate([
                        'tableName' => 'required|string'
                    ]);

                    $table = new Table;
                    $table->name = $request["tableName"];
                    $table->shortName = $request["tableShortName"];
                    $table->idOffice = $request["idOffice"];
                    $table->numberFlat = $request["numberFlat"];
                    $table->occupied  = self::STATUS_FALSE;
                    $table->isActive = self::STATUS_TRUE; 
                    $table->status = self::STATUS_TRUE;
                    $respuesta = $table->save();
                    
                    return $respuesta;
                } else {
                    DB::beginTransaction();
                    $countTable = $request["countTable"];
                    if($countTable > 0){
                        for($i=0; $i<$countTable; $i++){
                            
                            $table = new Table;
                            $table->name = "MESA " + ($i+1);
                            $table->shortName = $request["tableShortName"];
                            $table->idOffice = $request["idOffice"];
                            $table->numberFlat = $request["numberFlat"];
                            $table->occupied  = self::STATUS_FALSE;
                            $table->isActive = self::STATUS_TRUE; 
                            $table->status = self::STATUS_TRUE;
                            $table->save();
                        }
                    } else {
                        return response()->json([
                            'status' => SELF::STATUS_TRUE,
                            'msg' => "La cantidad de mesas debe ser mayor a cero."
                        ]);
                    }
                    DB::commit();
                }

            } else {
                $table = Table::find($request["idTable"]);
                $table->tableName = $request["tableName"];
                $respuesta = $table->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    public function getAllTableSupport ()  {
        try {
            $allTable = Table::get();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'tables' => $allTable
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getAllTable ()  {
        try {
            $allTable = DB::table('tables')->where("status", '=', self::STATUS_TRUE)->get();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'tables' => $allTable
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getTable (Request $request)  {
        try {
            $validatedData = $request->validate([
                'idTable' => 'required|numeric'
            ]);

            $table = DB::table('tables')->where("id","=",$validatedData["idTable"])->where("isActive","=", SELF::STATUS_TRUE)->where("status","=", SELF::STATUS_TRUE)->first();
            if (isset($table)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'tables' => $table
                ]);
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'tables' => "Id de mesa no encontrada"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteTable(Request $request){
        try {
            $validatedData = $request->validate([
                'idTable' => 'required|numeric'
            ]);
            $table = Table::find($validatedData["idTable"]);
            if (isset($table)) {
                $table->status = SELF::IS_DEACTIVE;
                $table->save();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Mesa eliminada correctamente"
                ]);
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'tables' => "Id de mesa no encontrada"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deactiveOrActiveTable(Request $request){
        try {
            $validatedData = $request->validate([
                'idTable' => 'required|numeric'
                ,'status' => 'required|boolean'
            ]);

            $table = Table::find($validatedData["idTable"]);
            if (isset($table)) {
                if ($validatedData["status"]) {
                    $table->isActive = SELF::IS_ACTIVE;
                    $table->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se activo la mesa correctamente"
                    ]);
                }else{
                    $table->isActive = SELF::IS_DEACTIVE;
                    $table->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se desactivo la mesa correctamente"
                    ]);
                }
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Id de mesa no encontrada"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
