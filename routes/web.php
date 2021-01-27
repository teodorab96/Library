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
//Početna strana
Route::get('/', [PagesController::class,'index']);

//Sve knjige i pretraga knjige
Route::get('/books', [PagesController::class,'books'])->name('books');
Route::post('/books',[PagesController::class,'books']);

//Login
Route::get('/home',[HomeController::class,'index'])->middleware('auth');

//prikazivanje greške kada se pokuša iznajmljivanje guest-a
Route::get('/books/{id}',[PagesController::class,'loginNeeded']);

//Slanje zahtjeva za izdavanje knjige
Route::get('/rentBook/{id}',[BooksController::class,'rent'])->middleware('auth');

//Istorija korisnika
Route::get('/history',[BooksController::class,'history'])->middleware('auth');

//Rezervacija knjige
Route::get('reserve/{id}',[BooksController::class,'reserve']);

//Administracija kod bibliotekara
Route::get('/allUsers',[LibrarianController::class,'index'])->middleware('auth');
Route::get('/allUsers/{id}',[LibrarianController::class,'approveUser'])->middleware('auth');
Route::get('/allBooks',[LibrarianController::class,'showBooks'])->middleware('auth');
Route::get('/addBook',[BooksController::class,'create'])->middleware('auth');
Route::post('/addBook',[BooksController::class,'store'])->middleware('auth');
Route::get('/reserveBook/{id}',[LibrarianController::class,'reserveBook'])->middleware('auth');
Route::post('/reserveBook',[LibrarianController::class,'reserve'])->middleware('auth');
Route::get('/requestBook',[LibrarianController::class,'requestBook'])->middleware('auth');
Route::get('/approveRent/{id}',[LibrarianController::class,'approveRentBook'])->middleware('auth');
Route::get('/deleteBook/{id}',[LibrarianController::class,'deleteBook'])->middleware('auth');
Route::get('/editBook/{id}',[LibrarianController::class,'editBook'])->middleware('auth');
Route::post('/editBook/{id}',[LibrarianController::class,'changeBook'])->middleware('auth');

//Dodavanje novog zaposlenog
Route::get('/addUser',[HomeController::class,'addUser'])->middleware('auth');
Route::post('/addUser',[HomeController::class,'storeUser'])->middleware('auth');
Auth::routes();