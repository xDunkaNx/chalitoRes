<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                        //'idRole' => 'required|numeric',
                   'personName' => 'required|string|min:3|max:50'
            , 'personMiddleName' => 'required|string|min:3|max:50'
              , 'personLastName' => 'required|string|min:3|max:50'
                , 'typeDocument' => 'required|string'
                    , 'document' => 'required|numeric'
                       , 'email' => 'required|email'
                   , 'cellPhone' => 'required|numeric'
            ]);

            $userNameSerarch = DB::table('Persons')->where("userName","=", $validatedData["document"])->first();
            if (isset($userNameSerarch)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "el nombre del usuario ya existe"
                ]);
            }

            $documentSearch = DB::table('Persons')->where("typeDocument","=", $validatedData["typeDocument"])->and_where("document", "=", $validatedData["document"])->first();
            if (isset($documentSearch)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Existe una persona con el mismo documento ya registrado"
                ]);
            }

            DB::beginTransaction();
            $person = Person::create([
                'personName' => $validatedData['personName'],
                'personMiddleName' => $validatedData['personMiddleName'],
                'personLastName' => $validatedData['personLastName'],
                'typeDocument' => $validatedData['typeDocument'],
                'document' => $validatedData['document'],
                'email' => $validatedData['email'],
                'cellPhone' => $validatedData['cellPhone'],
                'ruc' => array_key_exists('ruc', $validatedData) ? $validatedData['ruc'] : NULL,
                'razonSocial' => array_key_exists('razonSocial', $validatedData) ? $validatedData['razonSocial'] : NULL,
                'dob' => array_key_exists('dob', $validatedData) ? $validatedData['dob'] : NULL,
                'age' => array_key_exists('age', $validatedData) ? $validatedData['age'] : NULL,
                'phone' => array_key_exists('phone', $validatedData) ? $validatedData['phone'] : NULL,
                'address' => array_key_exists('address', $validatedData) ? $validatedData['address'] : NULL,
                'contactName' => array_key_exists('contactName', $validatedData) ? $validatedData['contactName'] : NULL,
                'contactPhone' => array_key_exists('contactPhone', $validatedData) ? $validatedData['contactPhone'] : NULL,
                'status' => SELF::STATUS_TRUE,
            ]);
            
            
            $client = Client::create([
                'id' => $person->id,
                'code' => $validatedData['document'],
                'startDate' => '2022-12-01',
                'isPensioner' => array_key_exists('isPensioner', $validatedData) ? $validatedData['isPensioner'] : 0,
                'pricePensioner' => array_key_exists('pricePensioner', $validatedData) ? $validatedData['pricePensioner'] : '0.00',
                'totalPoints' => array_key_exists('totalPoints', $validatedData) ? $validatedData['totalPoints'] : 0,
                'availablePoints' => array_key_exists('availablePoints', $validatedData) ? $validatedData['availablePoints'] : 0,
                'usedPoints' => array_key_exists('usedPoints', $validatedData) ? $validatedData['usedPoints'] : 0,
                'cancelPoints' => array_key_exists('cancelPoints', $validatedData) ? $validatedData['cancelPoints'] : 0,
                'isActive' => SELF::STATUS_TRUE,
                'status' => SELF::STATUS_TRUE
            ]);
            
            $createUser = array_key_exists('createUser', $validatedData) ? $validatedData['createUser'] : 0;
            
            if($createUser){
                /*
                $idRole = $validatedData['idRole'];
                $roleName = DB::table('roles')->select("name")->where("id","=", $idRole)->first();
                */
                $user = User::create([
                    'id' => $person->id,
                    'userName' => $validatedData['document'],
                    'password' => Hash::make($validatedData['document'])
                ])->assignRole("CLIENT");
            }
            
            $token = $user->createToken('authToken')->accessToken;
            DB::commit();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'msg' => "Registro de usuario exitoso",
                'access_token' => $token,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function getAllClient(){
        try 
        {
            $users = DB::table('users')->select("id","userName","email")->get();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getClient(Request $request){
        try 
        {
            $user = DB::table('users')->where("id","=",$request["idUser"])->first();
            if (isset($user)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'users' => $user
                ]);
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'users' => "Id de usuario no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteClient(Request $request){
        try 
        {
            $user = User::find($request["id"]);
            if (isset($user)) {
                $user->delete();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Usuario eliminado correctamente"
                ]);
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'users' => "Id de usuario no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function changeStatusClient(Request $request){
        try 
        {
            $user = User::find($request["idUser"]);
            if (isset($user)) {
                if ($request["status"]) {
                    DB::table('users')
                    ->where('id',"=", $request["idUser"])
                    ->update(['status' => SELF::STATUS_TRUE]);
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se activo el usuario correctamente"
                    ]);
                }else{
                    DB::table('users')
                    ->where('id',"=", $request["idUser"])
                    ->update(['status' => SELF::STATUS_FALSE]);
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se desactivo el usuario correctamente"
                    ]);
                }
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'users' => "Id de usuario no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
