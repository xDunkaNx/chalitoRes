<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client secret: UrxwbsxBwlrw6xH9A5t66dm8npbPgMapdYDVB5ca
Password grant client created successfully.
Client ID: 2
Client secret: 4XBmx60cU6xx6o0Ds6vfFSQvyYiY7tN*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post("Auth/register",[AuthContoller::class, 'register'])->name('Auth.register');
Route::post('/login',[AuthController::class, 'login']);
Route::get('/logOut',[AuthController::class, 'logOut'])->middleware(["auth:api","permission:infoUser,api"]);

// Route::group(['middleware' => ["auth:api", "role:Admin"]], function() {
    Route::get('/infoUser',[AuthController::class, 'infoUser'])->middleware(["auth:api","permission:infoUser,api"]);
    
    Route::post('/createOrUpdateUser',[UserController::class, 'createOrUpdateUser'])->middleware(["auth:api","permission:createOrUpdateUser,api"]);
    Route::get('/getAllUser',[UserController::class, 'getAllUser'])->middleware(["auth:api","permission:getAllUser,api"]);
    //Route::get('/{idUser}',[UserController::class, 'getUser'])->middleware(["auth:api","permission:getUser,api"]);
   // Route::delete('/{idUser}',[UserController::class, 'deleteUser'])->middleware(["auth:api","permission:deleteUser,api"]);
    Route::post('/changeStatusUser',[UserController::class, 'changeStatusUser'])->middleware(["auth:api","permission:changeStatusUser,api"]);
    
    Route::post('/createOrUpdateCategory',[CategoryController::class, 'createOrUpdateCategory'])->middleware(["auth:api","permission:createOrUpdateCategory,api"]);
    Route::get('/getAllCategory',[CategoryController::class, 'getAllCategory'])->middleware(["auth:api"]);
    Route::get('/getCategory',[CategoryController::class, 'getCategory'])->middleware(["auth:api","permission:getCategory,api"]);
    Route::get('/getCategoryName',[CategoryController::class, 'getCategoryName'])->middleware(["auth:api","permission:getCategoryName,api"]);
    
    Route::post('/createOrUpdateProduct',[ProductController::class, 'createOrUpdateProduct'])->middleware(["auth:api","permission:createOrUpdateProduct,api"]);
    Route::get('/getProduct',[ProductController::class, 'getProduct'])->middleware(["auth:api","permission:getProduct,api"]);
    Route::delete('/deleteProduct',[ProductController::class, 'deleteProduct'])->middleware(["auth:api","permission:deleteProduct,api"]);

    Route::post('/createRole',[RoleController::class, 'createRole'])->middleware(["auth:api","permission:createRole,api"]);
    Route::post('/assigRoleToUser',[RoleController::class, 'assigRoleToUser'])->middleware(["auth:api","permission:assigRoleToUser,api"]);
    Route::post('/assigPermissionToRole',[RoleController::class, 'assigPermissionToRole'])->middleware(["auth:api","permission:assigPermissionToRole,api"]);

    Route::get('/getAllDocumentType',[PersonController::class, 'getAllDocumentType'])->middleware(["auth:api","permission:getAllDocumentType,api"]);

    Route::get('/getAllRoleForSupport',[RoleController::class, 'getAllRoleForSupport'])->middleware(["auth:api","permission:getAllRoleForSupport,api"]);
// });


