<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    function createOrUpdateProduct (Request $request) {
        try {
            $validatedData = $request->validate([
                'idCategory' => 'required|numeric',
                'productName' => 'required|string|max:255',
                'productShortName' => 'required|string|max:255',
                'whitPresentation' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                //'group' => 'required|in:COMIDA,BEBIDA,POSTRE',
                'precio' => 'required|numeric',
                'code' => 'required|string|max:255',
                'image' => 'required|string|max:255'
    
            ]);
            if ($request["id"] == null) {
                $product = new Product;
                $product->idCategory = $validatedData["idCategory"];
                $product->productName = $validatedData["productName"];
                $product->productShortName = $validatedData["productShortName"];
                $product->description = $validatedData["description"];
                $product->whitPresentation = $validatedData["whitPresentation"];
                //$product->group = $validatedData["group"];
                $product->code = $validatedData["code"];
                $product->image = $validatedData["image"];
                $product->precio = $validatedData["precio"];
                $product->isActive = 1; 
                $product->status = 1;
                $product->save();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Agregaste un nuevo producto correctamente"
                ]);
            }
            else {
                $product = Product::find($request["id"]);
                if ($product == null) {
                    return 'El ID del producto que intenta actualizar no existe';
                }
                $product->idCategory = $validatedData["idCategory"];
                $product->productName = $request["productName"];
                $product->productShortName = $validatedData["productShortName"];
                $product->description = $validatedData["description"];
                $product->whitPresentation = $validatedData["whitPresentation"];
                //$product->group = $validatedData["group"];
                $product->code = $validatedData["code"];
                $product->image = $validatedData["image"];
                $product->precio = $validatedData["precio"];
                $product->isActive = 1; 
                $product->status = 1;
                $product->save();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Actualizaste el registro correctamente"
                ]);
            }
        } catch (Throwable $th) {
            //report($th);
            return $th;
        }

    }
    function getProduct (Request $request)  {
        try {
            $validatedData = $request->validate([
                'idProduct' => 'required|numeric'
            ]);

            $product = DB::table('products')->where("id","=",$validatedData["idProduct"])->where("isActive","=", SELF::STATUS_TRUE)->where("status","=", SELF::STATUS_TRUE)->first();
            if (isset($product)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'products' => $product
                ]);
            }else{
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Id de producto no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllProduct ()  {
        try {
            $product = DB::table('products')->where("status","=", SELF::STATUS_TRUE)->get();

            if (isset($product)) {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'products' => $product
                ]);
            } else {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'products' => "No existen prodcutos"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllProductSupport ()  {
        try {
            $allproduct = Product::get();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'products' => $allproduct
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function deleteProduct (Request $request) {
        try {
            $validatedData = $request->validate([
                'idProduct' => 'required|numeric'
            ]);

            $idProduct = Product::find($validatedData["idProduct"]);

            if (isset($idProduct)) {
                $idProduct->status = SELF::STATUS_FALSE;
                $idProduct->save();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Id Producto eliminado correctamente"
                ]);
            } else {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Id Producto no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function deactiveOrActiveProduct(Request $request){
        try {
            $validatedData = $request->validate([
                'idProduct' => 'required|numeric'
                ,'status' => 'required|boolean'
            ]);

            $product = Product::find($validatedData["idProduct"]);
            if (isset($product)) {
                if ($validatedData["status"]) {
                    $product->isActive = SELF::IS_ACTIVE;
                    $product->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se activo el producto correctamente"
                    ]);
                } else {
                    $product->isActive = SELF::IS_DEACTIVE;
                    $product->save();
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Se desactivo el producto correctamente"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "ID producto no encontrado"
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
