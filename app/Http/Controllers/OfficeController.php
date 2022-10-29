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
            return $allOffice;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllOffice ()  {
        try {
            $allOffice = Office::where("status", '=', self::STATUS_TRUE)->get();
            return $allOffice;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getOffice (Request $request)  {
        try {
            $validatedData = $request->validate(['idOffice' => 'required|numeric']);
            $allOffice = Office::where("isActive", '=', self::STATUS_TRUE)->and_where("status", '=', self::STATUS_TRUE)->and_where("idOffice", "=", $validatedData['idOffice'])->get();
            return $allOffice;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
