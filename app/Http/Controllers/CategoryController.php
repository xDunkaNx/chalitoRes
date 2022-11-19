<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
        try {
            $validatedData = $request->validate([
                'idCategory' => 'required|numeric'
            ]);

            $category = Category::find($validatedData['idCategory']);

            if(empty($category)){
                $category->isActive = SELF::STATUS_FALSE;
                $category->save();

                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "Categoria desactivada correctamente"
                ]);
                /* NOTA
                 * No es necesario desactivar todos los productos de la categoria, debido que en el listado de productos validamos
                 * el estado de la categoria tambien. 
                 * LO QUE SE PUEDE HACER ES CREAR UN TEMA DE NOTIFICACIONES, EL CUAL SE ENVIA UNA NOTIFICACION A LOS ADMINISTRADORES QUE 
                 * LA CATEOGIRA TAL FUE DESACTIVADA Y ALGUNOS PRODUCTOS YA NO SE MOSTRARAN PARA LA VENTA
                 */
            } else {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "No se encontro la categoria a desactivar"
                ]);
            }
        } catch (Throwable $th) {
            return $th;
        }
    }
    function deleteCategory (Request $request) {
        try {
            $validatedData = $request->validate(['idCategory' => 'required|numeric']);

            $category = Category::find($validatedData['idCategory']);

            if(empty($category)){
                $Products = Product::where("idCategory", "=", $validatedData['idCategory'])->get();
                if(count($Products) > 0){
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "La categoria a eliminar tiene productos relacionados"
                    ]);
                } else {
                    $category->status = SELF::STATUS_FALSE;
                    $category->save();
    
                    return response()->json([
                        'status' => SELF::STATUS_TRUE,
                        'msg' => "Categoria eliminada correctamente"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => SELF::STATUS_TRUE,
                    'msg' => "No se encontro la categoria a eliminar"
                ]);
            }
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
            $categories = Category::get();

            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'categories' => $categories
            ]);   
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getAllCategory (Request $request)  {
        try {
            $validatedData = $request->validate([
                'idCategory' => 'requerid|numeric'
            ]);
            
            $categories  = Category::where("status", '=', self::STATUS_TRUE)->get();
            if ($validatedData['idCategory'] != 0) {
                $idCategory = $validatedData["idCategory"];
                //usar 'raw' es peligroso por la sql inyeccion, hay otra manera mas eficiente con selectRaw, pero aun estoy revisando la doc.
                $categories = DB::table('categories')
                ->select('id','categoryName', DB::raw("IF(id={$idCategory},1,2) as orden"))
                ->orderBy('orden', 'asc')
                ->get();
            }
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'categories' => $categories
            ]);                
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function getCategory (Request $request) {
        try {
            $validatedData = $request->validate([
                'idCategory' => 'required|numeric'
            ]);
            $categories = DB::table('categories')->where("isActive", '=', self::STATUS_TRUE)->where("status", "=", self::STATUS_TRUE)->where("id", "=", $validatedData['idCategory'])->first();
            return response()->json([
                'status' => SELF::STATUS_TRUE,
                'categories' => $categories
            ]);                
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }



}