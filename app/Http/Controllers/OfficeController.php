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
    function getoffice ()  {
        try {
            $allOffice = Office::get();
            return $allOffice;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
