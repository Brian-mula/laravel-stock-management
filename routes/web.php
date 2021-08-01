<?php

use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('countries',CountryController::class);
Route::resource('cities',CityController::class);
Route::resource('customers',CustomerController::class);
Route::resource('employees',EmployeeController::class);
