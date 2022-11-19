<?php

namespace App\Http\Controllers;

use App\Models\CashBox;
use App\Models\User;
use Illuminate\Http\Request;

class CashBoxController extends Controller
{
    function createCashBox (Request $request) {
      try{
        $validatedData = $request->validate([
                  'idUser' => 'required|numeric'
              , 'idOffice' => 'required|numeric'
              , 'openDate' => 'required|string'
         , 'amountInitial' => 'required|double'

        ]);

        DB::beginTransaction();
        $cashBox = CashBox::create([
                   'idUser' => $validatedData['idUser']
               , 'idOffice' => $validatedData['idUser']
          , 'amountInitial' => $validatedData['idUser']
               , 'openDate' => '2022-12-31'
          , 'statusCashBox' => 'Abierto'
        ]);
        DB::commit();
        return response()->json([
          'status' => SELF::STATUS_TRUE,
          'msg' => "Registro de Caja exitoso"
      ]);
      } catch (\Throwable $th) {
            throw $th;
      }
    }
    function closeCashBox (Request $request) {
      try{
        $validatedData = $request->validate([
                  'idUser' => 'required|numeric'
              , 'idOffice' => 'required|numeric'
             , 'idCashBox' => 'required|numeric'
        ]);
  
        DB::beginTransaction();
        $idAdmin = array_key_exists('idAdmin', $request) ? $request['idAdmin'] : NULL;

        if($idAdmin === NULL) {

          $cashBox = CashBox::find($validatedData["idCashBox"]);
  
          if(empty($cashBox)){
            $cashBox->closeDate = '2022-12-31';
            $cashBox->statusCashBox = 'Cerrado';
            $response = $cashBox->save();
            return $response;
          } else {
            return response()->json([
              'status' => SELF::STATUS_TRUE,
              'msg' => "No se encontró el registro de caja"
            ]);
          }
        } else {

          $admin = User::find($idAdmin);
          if(!empty($admin)){
            $cashBox = CashBox::find($validatedData["idCashBox"]);

            if(empty($cashBox)){
              $cashBox->idAdmin = $admin->idUser;
              $cashBox->closeDate = '2022-12-31';
              $cashBox->statusCashBox = 'Cerrado';
              $cashBox->save();
            } else {
              return response()->json([
                'status' => SELF::STATUS_TRUE,
                'msg' => "No se encontró el registro de caja"
              ]);
            }
          } else {
            return response()->json([
              'status' => SELF::STATUS_TRUE,
              'msg' => "No existe el ID del administrador"
            ]);
          }
          
        }
        
        DB::commit();
        return response()->json([
          'status' => SELF::STATUS_TRUE,
          'msg' => "Registro de Caja exitoso"
        ]);
      } catch (\Throwable $th) {
            throw $th;
      }
      
    }
    function getAllCashBox ()  {
      try {
          $allCategory = CashBox::where("status", "=", self::STATUS_TRUE)->get();
          
          return response()->json([
            'status' => SELF::STATUS_TRUE,
            'cashbox' => $allCategory
          ]);
      } catch (\Throwable $th) {
        throw $th;
      }
    }
    function getCashBoxForUser (Request $request)  {
      try {
          $validatedData = $request->validate([
            'idUser' => 'required|numeric'
          ]);

          $category = CashBox::where("isActive", '=', self::STATUS_TRUE)->where("status", "=", self::STATUS_TRUE)->where("idUser", "=", $validatedData['idUser'])->first();

          return response()->json([
            'status' => SELF::STATUS_TRUE,
            'cashbox' => $category
          ]);
      } catch (\Throwable $th) {
        throw $th;
      }
    }
    
}
