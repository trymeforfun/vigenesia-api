<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/vigenesia/api/login', [TestController::class, "login"]);
Route::post('/vigenesia/api/registrasi', [TestController::class, "register"]);
Route::post('/vigenesia/api/dev/POSTmotivasi', [TestController::class, "storeMotivasi"]);
Route::delete('/vigenesia/api/dev/DELETEmotivasi', [TestController::class, "deleteMotivasi"]);
Route::put('/vigenesia/api/dev/PUTmotivasi', [TestController::class, "putMotivasi"]);
Route::get('/vigenesia/api/Get_motivasi', [TestController::class, "getMotivasiByUserId"]);
