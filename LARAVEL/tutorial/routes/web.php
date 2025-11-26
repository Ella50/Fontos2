<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesztController;
//use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teszt', [TesztController::class, 'teszt']);
Route::get('/names', [TesztController::class, 'names']);
Route::get('/names/create/{family}/{name}', [TesztController::class,'namesCreate'])->middleware('auth');
Route::get('/families/create/{name}', [TesztController::class,'familiesCreate'])->middleware('auth');
Route::post('/names/delete', [TesztController::class,'deleteName'])->middleware('auth');
Route::get('/names/manage/surname', [TesztController::class,'manageSurname'])->middleware('auth'); //middleware('auth'): csak a bejelentkezett felhasználók tudja megnyitni
Route::post('/names/manage/surname/delete', [TesztController::class,'deleteSurname'])->middleware('auth');
Route::post('/names/manage/surname/new', [TesztController::class,'newSurname'])->middleware('auth');
Route::post('/names/manage/name/new', [TesztController::class,'newName'])->middleware('auth');

Auth::routes();
Route::get('/profile', function () { return view('pages.profile');})->middleware('auth');
Route::post('/profile/change-password', [UserController::class,'changePassword'])->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
