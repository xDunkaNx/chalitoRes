<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    function createOrUpdatepresentation (Request $request) {
        try {
            if ($request["idPresentation"] == null) {
                $presentation = new Presentation;
                $presentation->presentationName = $request["presentationName"];
                $presentation->isActive = 1; 
                $presentation->status = 1;
                $respuesta = $presentation->save();
                return $respuesta;
            }
            else {
                $presentation = Presentation::find($request["idPresentation"]);
                $presentation->presentationName = $request["presentationName"];
                $respuesta = $presentation->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getpresentation ()  {
        try {
            $allpresentation = Presentation::get();
            return $allpresentation;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
