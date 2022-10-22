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
    public function getTable ()  {
        try {
            $allTable = Table::get();
            return $allTable;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteTable(Request $request){
        try {

            $table = Table::find($request["idTable"]);
            if (isset($table)) {
                $table->delete();
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
    public function changeStatusTable(Request $request){
        try {

            $table = Table::find($request["idTable"]);
            if (isset($table)) {
                if ($request["status"]) {
                    DB::table('tables')
                    ->where('idTable',"=", $request["idTable"])
                    ->update(['status' => SELF::STATUS_TRUE]);
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se activo la mesa correctamente"
                    ]);
                }else{
                    DB::table('tables')
                    ->where('idTable',"=", $request["idTable"])
                    ->update(['status' => SELF::STATUS_FALSE]);
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se desactivo la mesa correctamente"
                    ]);
                }
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
}
