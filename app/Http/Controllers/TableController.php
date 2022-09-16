<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    function createOrUpdateTable (Request $request) {
        try {
            if ($request["idTable"] == null) {
                $table = new Table;
                $table->tableName = $request["tableName"];
                $table->isActive = 1; 
                $table->status = 1;
                $respuesta = $table->save();
                return $respuesta;
            }
            else {
                $table = Table::find($request["idTable"]);
                $table->tableName = $request["tableName"];
                $respuesta = $table->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    function getTable ()  {
        try {
            $allTable = Table::get();
            return $allTable;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
