<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [ProfileController::class, 'userType']);
Route::post('/logout', function () {
    return view('home');
});



Route::get('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'handleRegister']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'handleLogin']);

//====== STUDENT
/*Route::get('/students', function () {
    return view('student/profile');
});*/

Route::get('/user/profile/{id}', [ProfileController::class, 'showProfile']);
Route::get('/user/update', [ProfileController::class, 'updateProfile']);
Route::post('/user/update', [ProfileController::class, 'handleUpdateProfile']);
Route::get('/user/applications', [ProfileController::class, 'showApplications']);



//=== Students applications
/*Route::get('/students/{id}/applications', function () {
    return view('home');
});

Route::get('/students/{id}/applications/{application_id}', function () {
    return view('home');
});*/

//======= COMPANY
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{company}', [CompanyController::class, 'show']);
Route::get('/companies/{company}/internships', [CompanyController::class, 'indexInternships']);
Route::get('/companies/{company}/internships/{internship}', [CompanyController::class, 'showInternship']);
// Route::get('/companies', function () {
//     return view('company/profile');
// });
Route::get('/company/profile/{id}', [CompanyController::class, 'showCompany']);
Route::post('/company/profile/{id}', [CompanyController::class, 'addInternshipOffer']);

Route::get('/company/addInternship/{id}', [CompanyController::class, 'addInternship']);
Route::post('/company/addInternship/{id}', [CompanyController::class, 'handleAddInternship']);

Route::get('/company/add', [CompanyController::class, 'addCompany']);
Route::post('/company/add', [CompanyController::class, 'handleAddCompany']);

Route::get('/company/update/{id}', [CompanyController::class, 'updateCompany']);
Route::post('/company/update/{id}', [CompanyController::class, 'handleUpdateCompany']);

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
