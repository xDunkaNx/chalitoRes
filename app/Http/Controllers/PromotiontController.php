<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    function createOrUpdatepromotion (Request $request) {
        try {
            if ($request["idpromotion"] == null) {
                $promotion = new Promotion;
                $promotion->promotionName = $request["promotionName"];
                $promotion->isActive = 1; 
                $promotion->status = 1;
                $respuesta = $promotion->save();
                return $respuesta;
            }
            else {
                $promotion = Promotion::find($request["idPromotion"]);
                $promotion->promotionName = $request["promotionName"];
                $respuesta = $promotion->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    function getPromotion ()  {
        try {
            $allpromotion = Promotion::get();
            return $allpromotion;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
