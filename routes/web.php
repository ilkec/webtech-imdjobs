<?php

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
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/logout', function () {
    return view('home');
});

Route::any('/register', function () {
    return view('signup');
});

//====== STUDENT
Route::get('/students', function () {
    return view('student/profile');
});

Route::any('/students/{id}', function () {
    return view('student/details');
});

//=== Students applications
/*Route::get('/students/{id}/applications', function () {
    return view('home');
});

Route::get('/students/{id}/applications/{application_id}', function () {
    return view('home');
});*/

//======= COMPANY
Route::get('/companies', function () {
    return view('company/profile');
});

Route::any('/companies/{id}', function () {
    return view('company/details');
});
//=======company Vacatures
/*Route::any('/companies/{id}/vacatures', function () {
    return view('home');
});
Route::any('/companies/{id}/vacatures/{vacature_id}', function () {
    return view('home');
});*/


// Vacatures?
Route::get('/vacatures', function () {
    return view('home');
});
