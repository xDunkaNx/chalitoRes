<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function createOrUpdateCity (Request $request) {
        try {
            if ($request["idCity"] == null) {
                $city = new City;
                $city->cityName = $request["cityName"];
                $city->isActive = 1; 
                $city->status = 1;
                $respuesta = $city->save();
                return $respuesta;
            }
            else {
                $city = city::find($request["idCity"]);
                $city->cityName = $request["cityName"];
                $respuesta = $city->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    function getAllCity ()  {
        try {
            $allCity = City::get();
            return $allCity;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
