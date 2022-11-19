<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CashBoxController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
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
    Route::get('/getAllUserSupport',[UserController::class, 'getAllUserSupport'])->middleware(["auth:api","permission:getAllUserSupport,api"]);
    Route::get('/getAllUser',[UserController::class, 'getAllUser'])->middleware(["auth:api","permission:getAllUser,api"]);
    Route::post('/getUser',[UserController::class, 'getUser'])->middleware(["auth:api","permission:getUser,api"]);
    Route::post('/deleteUser',[UserController::class, 'deleteUser'])->middleware(["auth:api","permission:deleteUser,api"]);
    Route::post('/deactiveOrActiveUser',[UserController::class, 'deactiveOrActiveUser'])->middleware(["auth:api","permission:deactiveOrActiveUser,api"]);
    
    Route::post('/createOrUpdateCategory',[CategoryController::class, 'createOrUpdateCategory'])->middleware(["auth:api","permission:createOrUpdateCategory,api"]);
    Route::post('/deactivateCategory',[CategoryController::class, 'deactivateCategory'])->middleware(["auth:api","permission:deactivateCategory,api"]);
    Route::post('/deleteCategory',[CategoryController::class, 'deleteCategory'])->middleware(["auth:api","permission:deleteCategory,api"]);
    Route::get('/getCategoryName',[CategoryController::class, 'getCategoryName'])->middleware(["auth:api","permission:getCategoryName,api"]);
    Route::get('/getAllCategoryForSupport',[CategoryController::class, 'getAllCategoryForSupport'])->middleware(["auth:api","permission:getAllCategoryForSupport,api"]);
    Route::get('/getAllCategory',[CategoryController::class, 'getAllCategory'])->middleware(["auth:api"]);
    Route::get('/getCategory',[CategoryController::class, 'getCategory'])->middleware(["auth:api","permission:getCategory,api"]);
    
    Route::post('/createOrUpdateProduct',[ProductController::class, 'createOrUpdateProduct'])->middleware(["auth:api","permission:createOrUpdateProduct,api"]);
    Route::get('/getProduct',[ProductController::class, 'getProduct'])->middleware(["auth:api","permission:getProduct,api"]);
    Route::get('/getAllProduct',[ProductController::class, 'getAllProduct'])->middleware(["auth:api","permission:getAllProduct,api"]);
    Route::get('/getAllProductSupport',[ProductController::class, 'getAllProductSupport'])->middleware(["auth:api","permission:getAllProductSupport,api"]);
    Route::delete('/deleteProduct',[ProductController::class, 'deleteProduct'])->middleware(["auth:api","permission:deleteProduct,api"]);
    Route::delete('/deactiveOrActiveProduct',[ProductController::class, 'deactiveOrActiveProduct'])->middleware(["auth:api","permission:deactiveOrActiveProduct,api"]);

    Route::post('/createRole',[RoleController::class, 'createRole'])->middleware(["auth:api","permission:createRole,api"]);
    Route::post('/assigRoleToUser',[RoleController::class, 'assigRoleToUser'])->middleware(["auth:api","permission:assigRoleToUser,api"]);
    Route::post('/assigPermissionToRole',[RoleController::class, 'assigPermissionToRole'])->middleware(["auth:api","permission:assigPermissionToRole,api"]);
    Route::post('/getAllRoleForSupport',[RoleController::class, 'getAllRoleForSupport'])->middleware(["auth:api","permission:getAllRoleForSupport,api"]);
    Route::post('/getAllRole/{idUser}',[RoleController::class, 'getAllRole'])->middleware(["auth:api","permission:getAllRole,api"]);
    Route::post('/getRole',[RoleController::class, 'getRole'])->middleware(["auth:api","permission:getRole,api"]);
    Route::post('/deleteRole',[RoleController::class, 'deleteRole'])->middleware(["auth:api","permission:deleteRole,api"]);
    Route::post('/deactiveOrActiveRole',[RoleController::class, 'deactiveOrActiveRole'])->middleware(["auth:api","permission:deactiveOrActiveRole,api"]);

    Route::post('/getAllDocumentType/{idPerson}',[PersonController::class, 'getAllDocumentType'])->middleware(["auth:api","permission:getAllDocumentType,api"]);


    Route::post('/createCashBox',[CashBoxController::class, 'createCashBox'])->middleware(["auth:api","permission:createCashBox,api"]);
    Route::post('/closeCashBox',[CashBoxController::class, 'closeCashBox'])->middleware(["auth:api","permission:closeCashBox,api"]);
    Route::post('/getAllCashBox',[CashBoxController::class, 'getAllCashBox'])->middleware(["auth:api","permission:getAllCashBox,api"]);
    Route::post('/getCashBoxForUser',[CashBoxController::class, 'getCashBoxForUser'])->middleware(["auth:api","permission:getCashBoxForUser,api"]);
    
    Route::post('/createOrUpdatedocument',[DocumentController::class, 'createOrUpdatedocument'])->middleware(["auth:api","permission:createOrUpdatedocument,api"]);
    Route::post('/getdocument',[DocumentController::class, 'getdocument'])->middleware(["auth:api","permission:getdocument,api"]);
    
    Route::post('/createOrUpdateOffice',[OfficeController::class, 'createOrUpdateOffice'])->middleware(["auth:api","permission:createOrUpdateOffice,api"]);
    Route::post('/getAllOffice/{idUser}',[OfficeController::class, 'getAllOffice'])->middleware(["auth:api","permission:getAllOffice,api"]);
    Route::post('/getOffice',[OfficeController::class, 'getOffice'])->middleware(["auth:api","permission:getOffice,api"]);
    Route::post('/deleteOffice',[OfficeController::class, 'deleteOffice'])->middleware(["auth:api","permission:deleteOffice,api"]);
    Route::post('/deactiveOrActiveOffice',[OfficeController::class, 'deactiveOrActiveOffice'])->middleware(["auth:api","permission:deactiveOrActiveOffice,api"]);
    
    Route::post('/createOrUpdateTable',[TableController::class, 'createOrUpdateTable'])->middleware(["auth:api","permission:createOrUpdateTable,api"]);
    Route::post('/getAllTableSupport',[TableController::class, 'getAllTableSupport'])->middleware(["auth:api","permission:getAllTableSupport,api"]);
    Route::post('/getAllTable',[TableController::class, 'getAllTable'])->middleware(["auth:api","permission:getAllTable,api"]);
    Route::post('/getTable',[TableController::class, 'getTable'])->middleware(["auth:api","permission:getTable,api"]);
    Route::post('/deleteTable',[TableController::class, 'deleteTable'])->middleware(["auth:api","permission:deleteTable,api"]);
    Route::post('/deactiveOrActiveTable',[TableController::class, 'deactiveOrActiveTable'])->middleware(["auth:api","permission:deactiveOrActiveTable,api"]);
// });


