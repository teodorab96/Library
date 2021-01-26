<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LibrarianController;
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

Route::get('/', [PagesController::class,'index']);
Route::get('/books', [PagesController::class,'books'])->name('books');
Route::post('/books',[PagesController::class,'books']);
Route::get('/books/{id}',[PagesController::class,'loginNeeded']);
Route::get('/rentBook/{id}',[BooksController::class,'rent'])->middleware('auth');
Route::get('/history',[BooksController::class,'history'])->middleware('auth');
Route::get('reserve/{id}',[BooksController::class,'reserve']);
Route::get('/allUsers',[LibrarianController::class,'index'])->middleware('auth');
Route::get('/allUsers/{id}',[LibrarianController::class,'approveUser'])->middleware('auth');
Route::get('/allBooks',[LibrarianController::class,'showBooks'])->middleware('auth');
Route::get('/home',[HomeController::class,'index'])->middleware('auth');
Route::get('/addBook',[BooksController::class,'create'])->middleware('auth');
Route::post('/addBook',[BooksController::class,'store'])->middleware('auth');
Route::get('/reserveBook/{id}',[LibrarianController::class,'reserveBook'])->middleware('auth');
Route::post('/reserveBook',[LibrarianController::class,'reserve'])->middleware('auth');
Auth::routes();
Route::get('/lgout',function(){
    Session::forget('user_type');
    Session::forget('status');
    Session::flush();
    dd(Auth::user()->type);
    return view('pages.index');
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
