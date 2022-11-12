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
    function getAllDocumentType ($idPerson)  {
        try {
            $a_resp =  SELF::a_DOCUMENT_TYPE_PERSON;
            if($idPerson > 0 ){
                $o_person = Person::find($idPerson);
                if(is_null($o_person)) {
                    $a_resp =  [];
                } else {
                    foreach ($a_resp as $key => $valor) {
                        if($valor['value'] == $o_person->typeDocument){
                            $a_resp[$key]['selected'] = true;
                        } else {
                            $a_resp[$key]['selected'] = false;
                        }
                    }
                }
            }
            
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'typeDocuments' => $a_resp
            ]);
     
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
