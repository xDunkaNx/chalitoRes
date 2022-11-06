<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    function createOrUpdateperson (Request $request) {
        try {
            if ($request["idperson"] == null) {
                $person = new Person;
                $person->personName = $request["personName"];
                $person->isActive = 1; 
                $person->status = 1;
                $respuesta = $person->save();
                return $respuesta;
            }
            else {
                $person = Person::find($request["idPerson"]);
                $person->personName = $request["personName"];
                $respuesta = $person->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    function getperson ()  {
        try {
            $allperson = Person::get();
            return $allperson;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllDocumentType (Request $request)  {
        try {
            if ($request['idPerson'] == 0) {
                $stringResp = "";
                $a_resp = array();
                    $result = DB::table('persons')
                    ->select(DB::raw('SUBSTRING(COLUMN_TYPE, 6, LENGTH(COLUMN_TYPE) - 6) AS val'))
                    ->from('information_schema.COLUMNS')
                    ->where( 'TABLE_NAME', '=', "persons")
                    ->where( 'COLUMN_NAME', '=', "typeDocument")
                    ->get();
                    $stringResp = $result[0]->val;
                    //convertimos la cadena a un arreglo de opciones segun las concidencias pasadas en los parametros
                    $a_resp = str_getcsv($stringResp, ',', "'");
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'typeDocuments' => $a_resp
                    ]);
            }else {
                var_dump("se tiene que regresar la lista de documentos ordenada segun el id de la persona");
            }
     
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
