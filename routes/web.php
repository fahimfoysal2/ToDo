<?php

use App\Http\Controllers\TodoController;
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

Route::get('/{home?}', function (){
    return view('welcome');
})->where('home', 'todo|home');

Route::get('/login', function (){
   return view('login');
})->name('login');

Route::get('/register', function (){
    return view('register');
})->name('register');

Route::get('/todo/{todo}/edit', [TodoController::class, 'edit']);
