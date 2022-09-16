<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    function createOrUpdatedocument (Request $request) {
        try {
            if ($request["idDocument"] == null) {
                $document = new Document;
                $document->documentName = $request["documentName"];
                $document->isActive = 1; 
                $document->status = 1;
                $respuesta = $document->save();
                return $respuesta;
            }
            else {
                $document = Document::find($request["idDocument"]);
                $document->documentName = $request["documentName"];
                $respuesta = $document->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getdocument ()  {
        try {
            $alldocument = Document::get();
            return $alldocument;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
