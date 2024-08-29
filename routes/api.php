<?php

use App\Http\Controllers\makananController;
use App\Http\Controllers\pemesananController;
use App\Http\Controllers\ratingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\restoranController;
use App\Http\Controllers\userController;
use App\Http\Controllers\mejaController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\cartDetailController;
use App\Http\Controllers\API\AuthController;
// use App\Http\Controllers\ratingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AUTH

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('checkToken', 'checkToken');

});

//Restoran
Route::get('/getRestoran',[restoranController::class,'getRestoran']);
Route::post('/addRestoran',[restoranController::class,'addRestoran']);
Route::put('/updateRestoran/{id}',[restoranController::class,'updateRestoran']);
Route::delete('/deleteRestoran/{id}',[restoranController::class,'deleteRestoran']);
Route::get('/getRestoranId/{id}',[restoranController::class,'getRestoranId']);

//User
Route::get('/getUser',[userController::class,'getUser']);
Route::post('/addUser',[userController::class,'addUser']);
Route::put('/updateUser/{id}',[userController::class,'updateUser']);
Route::patch('/updateStatus/{id}',[userController::class,'updateStatus']);
Route::delete('/deleteUser/{id}',[userController::class,'deleteUser']);
Route::get('/getUserId/{id}',[userController::class,'getUserId']);

//Makanan
Route::get('/getMakanan',[makananController::class,'getMakanan']);
Route::post('/addMakanan',[makananController::class,'addMakanan']);
Route::put('/updateMakanan/{id}',[makananController::class,'updateMakanan']);
Route::delete('/deleteMakanan/{id}',[makananController::class,'deleteMakanan']);
Route::get('/getMakananId/{id}',[makananController::class,'getMakananId']);

//Pemesanan
Route::get('/getPemesanan',[pemesananController::class,'getPemesanan']);
Route::post('/addPemesanan',[pemesananController::class,'addPemesanan']);
Route::put('/updatePemesanan/{id}',[pemesananController::class,'updatePemesanan']);
Route::delete('/deletePemesanan/{id}',[pemesananController::class,'deletePemesanan']);
Route::get('/getPemesananId/{id}',[pemesananController::class,'getPemesananId']);

//Rating
Route::get('/getRating', [ratingController::class, 'getRating']);
Route::get('/getRatingId/{id}', [ratingController::class, 'getRatingId']);
Route::post('/addRating', [ratingController::class, 'addRating']);
Route::put('/updateRating/{id}', [ratingController::class, 'updateRating']);
Route::delete('/deleteRating/{id}', [ratingController::class, 'deleteRating']);
Route::get('/getDetailRating', [ratingController::class, 'getDetailRating']);
Route::get('/getDetailRatingId/{id}', [ratingController::class, 'getDetailRatingId']);
Route::post('/addDetailRating/{id}', [ratingController::class, 'addDetailRating']);
Route::delete('/deleteDetailRating/{id}', [ratingController::class, 'deleteDetailRating']);
Route::patch('/updateDetailRating/{id}', [ratingController::class, 'updateDetailRating']);

//Meja
Route::get('/getMeja', [mejaController::class, 'getMeja']);
Route::get('/getMejaRestoran/{id}', [mejaController::class, 'getMejaRestoran']);
Route::post('/addMeja', [mejaController::class, 'addMeja']);
Route::patch('/updateMeja/{id}', [mejaController::class, 'updateMeja']);
Route::patch('/updateStatusPenuh/{id}', [mejaController::class, 'updateStatusPenuh']);
Route::patch('/updateStatusKosong/{id}', [mejaController::class, 'updateStatusKosong']);
Route::delete('/deleteMeja/{id}', [mejaController::class, 'deleteMeja']);

//cart
Route::get('/getCart', [cartController::class, 'getCart']);
Route::post('/addCart', [cartController::class, 'addCart']);
Route::patch('/setConfirmed/{id}', [cartController::class, 'setConfirmed']);
Route::patch('/setCancel/{id}', [cartController::class, 'setCancel']);
Route::patch('/updateCartMeja/{id}', [cartController::class, 'updateCartMeja']);
Route::get('/getCartId/{id}', [cartController::class, 'getCartId']);
Route::get('/getCartIdUser/{id}', [cartController::class, 'getCartIdUser']);
Route::delete('/deleteCart/{id}', [cartController::class, 'deleteCart']);

//cartDetail

Route::get('/getCartDetail', [cartDetailController::class, 'getCartDetail']);
Route::get('/getCartDetailId/{id}', [cartDetailController::class, 'getCartDetailId']);
Route::post('/addCartDetail/{id}', [cartDetailController::class, 'addCartDetail']);
Route::patch('/updateCartDetail/{id}', [cartDetailController::class, 'updateCartDetail']);
Route::delete('/deleteCartDetail/{id}', [cartDetailController::class, 'deleteCartDetail']);

//
//Route::('/', [mejaController::class, '']);
//Route::('/', [cartController::class, '']);

//Route::('', [::class, '']);