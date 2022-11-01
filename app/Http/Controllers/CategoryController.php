<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryController extends Controller
{
    function createOrUpdateCategory (Request $request) {
        try {
            $validatedData = $request->validate([
                'categoryName' => 'required|string|max:255'
            ]);
            if ($request["idCategory"] == null) {
                $category = new Category;
                $category->categoryName = $validatedData["categoryName"];
                $category->isActive = 1; 
                $category->status = 1;
                $respuesta = $category->save();
                return $respuesta;
            }
            else {
                $category = Category::find($request["idCategory"]);
                $category->categoryName = $validatedData["categoryName"];
                $respuesta = $category->save();
                return $respuesta;
            }
    

        } catch (\Throwable $th) {
            return $th;
        }
    }
    function deactivateCategory (Request $request) {
        //creo que deberia poderc desactivar la categoria cambiando de status y ver si los platos que estan relacionados a esa
        //categoria tambien se desactivan
        try {

        } catch (Throwable $th) {
            return $th;
        }
    }
    function getCategoryName (Request $request) {
        try {
            $value = $request["categoryName"];
            return Category::where("categoryName", 'like', '%'.$value.'%')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllCategoryForSupport ()  {
        try {
            return Category::get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllCategory (Request $request)  {
        try {
            $validatedData = $request->validate(['idCategory' => 'numeric']);
            if ($validatedData['idCategory'] != 0) {
                $idCategory = $validatedData["idCategory"];
                //usar 'raw' es peligroso por la sql inyeccion, hay otra manera mas eficiente con selectRaw, pero aun estoy revisando la doc.
                $categories = DB::table('categories')
                ->select('id','categoryName', DB::raw("IF(id={$idCategory},1,2) as orden"))
                ->orderBy('orden', 'asc')
                ->get();
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'categories' => $categories
                ]);
            }       
            else{
               $categories  = Category::select('id','categoryName')->get();
               return response()->json([
                'status' => SELF::STATUS_TRUE,
                'categories' => $categories
            ]);
                
            }
            return Category::where("status", '=', self::STATUS_TRUE)->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getCategory (Request $request) {
        try {
            $validatedData = $request->validate(['idCategory' => 'required|numeric']);
            return DB::table('categories')->where("isActive", '=', self::STATUS_TRUE)->where("status", "=", self::STATUS_TRUE)->where("id", "=", $validatedData['idCategory'])->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }



}