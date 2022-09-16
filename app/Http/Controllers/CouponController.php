<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function createOrUpdateCoupon (Request $request) {
        try {
            if ($request["idCoupon"] == null) {
                $Coupon = new Coupon;
                $Coupon->CouponName = $request["CouponName"];
                $Coupon->isActive = 1; 
                $Coupon->status = 1;
                $respuesta = $Coupon->save();
                return $respuesta;
            }
            else {
                $Coupon = Coupon::find($request["idCoupon"]);
                $Coupon->CouponName = $request["CouponName"];
                $respuesta = $Coupon->save();
                return $respuesta;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getCoupon ()  {
        try {
            $allCoupon = Coupon::get();
            return $allCoupon;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
