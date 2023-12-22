<?php

use App\Http\Controllers\DonviApiController;
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

Route::get('getDonvi', [DonviApiController::class, 'donvi']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('guestlogin', 'App\Http\Controllers\AuthController@guestLogin');
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('refreshtoken', 'App\Http\Controllers\AuthController@getTokenAndRefreshTokenByRefreshToken');
    Route::post('forgetpassword', 'App\Http\Controllers\AuthController@forgetPassword');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

    //Route::post('otp', 'App\Http\Controllers\AuthController@validOTP');
    Route::post('sendotp', 'App\Http\Controllers\AuthController@sendOTP');

    Route::post('register/validate', 'App\Http\Controllers\AuthController@validateRegister');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('user', 'App\Http\Controllers\AuthController@user');
        Route::post('changepassword', 'App\Http\Controllers\AuthController@changePassword');
        Route::post('info', 'App\Http\Controllers\AuthController@getInfors');
        Route::post('updateinfo', 'App\Http\Controllers\AuthController@updateUserInfo');
    });
});


// Thêm token device
Route::group([
    'prefix' => 'token'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('add', 'App\Http\Controllers\TokenApiController@AddToken');
    });
});

// Danh sách tin tức
Route::group([
    'prefix' => 'news'
], function () {
    Route::post('list', 'App\Http\Controllers\TinTucApiController@GetDsTinTucs');
    Route::post('getbycategory', 'App\Http\Controllers\TinTucApiController@GetDsTinTucsByCategory');
    Route::post('getcategories', 'App\Http\Controllers\TinTucApiController@GetCategories');
});

// Danh sách khảo sát
Route::group([
    'prefix' => 'khaosat'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('danh-sach', 'App\Http\Controllers\KhaoSatApiController@GetDsKhaoSats');
    });
});

// Danh sách thông báo
Route::group([
    'prefix' => 'thongbao'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('danh-sach', 'App\Http\Controllers\ThongBaoApiController@GetDsThongBaos');
        Route::post('da-xem', 'App\Http\Controllers\ThongBaoApiController@CapNhatDocThongBao');
    });
});
