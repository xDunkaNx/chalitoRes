<?php

use App\Http\Controllers\AuthController;
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

Route::group(['middleware' => ["auth:api"]], function() {
    Route::post('/register',[UserController::class, 'register']);
    Route::get('/infoUser',[AuthController::class, 'infoUser']);
    Route::get('/logOut',[AuthController::class, 'logOut']);
    Route::post('/createOrUpdateCategory',[CategoryController::class, 'createOrUpdateCategory']);
    Route::get('/getCategory',[CategoryController::class, 'getCategory']);
    Route::get('/getCategoryName',[CategoryController::class, 'getCategoryName']);
    
    Route::post('/createOrUpdateProduct',[ProductController::class, 'createOrUpdateProduct']);
    Route::get('/getProduct',[ProductController::class, 'getProduct']);
    Route::delete('/deleteProduct',[ProductController::class, 'deleteProduct']);
});


