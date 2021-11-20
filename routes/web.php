<?php

use App\Http\Controllers\InecController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    return redirect('/index');
});

Route::get('/index', [InecController::class, 'index']);
Route::get('initiate', [InecController::class, 'getResetPassword']);
Route::get('/ajax/data/lgas', [InecController::class, 'getLgas']);
Route::get('/ajax/data/wards', [InecController::class, 'getWards']);
Route::get('/ajax/data/polling-units', [InecController::class, 'getPollingUnit']);
Route::post('/index', [InecController::class, 'getPollingUnitResults']);
Route::get('/party/result/add', [InecController::class, 'getAddResultsPage']);
Route::post('/polling-unit/result/add', [InecController::class, 'doAddResult']);
Route::get('/lga/result', [InecController::class, 'getLgaResult']);
Route::post('/lga/result', [InecController::class, 'doLgaResult']);
