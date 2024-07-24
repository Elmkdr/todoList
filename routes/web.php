<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\HomeController;
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
Route::get('/hello', function () {
    return view('hello');
});

Auth::routes();

Route::prefix('todos')->middleware('auth')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/{todo}', [TodoController::class, 'show'])->name('todos.show');
    Route::get('/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/{todo}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');



//Route::resource('todos', TodoController::class)->middleware('auth');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
