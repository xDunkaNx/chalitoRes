<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

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
}
