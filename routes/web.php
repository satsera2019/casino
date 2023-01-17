<?php

use App\Http\Controllers\UserPanel\AuthController;
use App\Http\Controllers\UserPanel\DepositController;
use App\Http\Controllers\UserPanel\IndexController;
use App\Http\Controllers\UserPanel\SlotController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->name('cabinet.')->prefix('cabinet')->group(function () {
    
    Route::get('/', [IndexController::class, 'index'])->name('main');

    Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::post('/withdraw', [DepositController::class, 'withdraw'])->name('withdraw');

    Route::name('slots.')->prefix('slots')->group(function () {
        Route::get('/index', [SlotController::class, 'index'])->name('index');
        Route::post('/spin', [SlotController::class, 'spin'])->name('spin');
    });


});
