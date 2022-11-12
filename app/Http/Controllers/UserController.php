<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function createOrUpdateUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                        'idRole' => 'required|numeric'
                    , 'userName' => 'required|string|max:255'
                    , 'password' => 'required|string|min:6' //123456
                    , 'password' => 'required|confirmed' //se valida confirmacion de pass el campo enviado seria password_confirmation
                  , 'personName' => 'required|string|min:3|max:50'
            , 'personMiddleName' => 'required|string|min:3|max:50'
              , 'personLastName' => 'required|string|min:3|max:50'
                , 'typeDocument' => 'required|string'
                    , 'document' => 'required|numeric'
                       , 'email' => 'required|email'
                   , 'cellPhone' => 'required|numeric'
            ]);
            $userNameSearch = DB::table('users')->where("userName","=", $validatedData["userName"])->first();
            if (isset($userNameSearch)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "el nombre del usuario ya existe"
                ]);
            }
            $documentSearch = DB::table('Persons')->where("typeDocument","=", $validatedData["typeDocument"])->where("document", "=", $validatedData["document"])->first();
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
            //$person->save();
            $idRole = $validatedData['idRole'];
            $roleName = DB::table('roles')->select("name")->where("id","=", $idRole)->first();
            $user = new User;
            $user->idUser = $person->id;
            $user->userName = $validatedData['userName'];
            $user->password = Hash::make($validatedData['password']); 
            $user->save();
            $token = $user->assignRole($roleName->name)->createToken('authToken')->accessToken;
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
    public function getAllUser(){
        try {
            $users = DB::table('users')->where("isActive", '=', self::STATUS_TRUE)->get();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getUser(Request $request){
        try {

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
    public function deleteUser(Request $request){
        try {

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
    public function changeStatusUser(Request $request){
        try {

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
