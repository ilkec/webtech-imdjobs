<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InternshipController;

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

/* --- HOME + LOGIN --- */
//home
Route::get('/', [ProfileController::class, 'showHome']);
//register
Route::get('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'handleRegister']);
//login
Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'handleLogin']);
//logout
Route::get('/logout', [UserController::class, 'logout']);


/* --- profile --- */
//show profile
Route::get('/user/profile/{id}', [ProfileController::class, 'showProfile']);
//update profile
Route::get('/user/update', [ProfileController::class, 'updateProfile']);
Route::post('/user/update', [ProfileController::class, 'handleUpdateProfile']);

/* --- company --- */
//plural
//companies
Route::get('/companies', [CompanyController::class, 'index']);
Route::post('/companies', [CompanyController::class, 'filterCompanies']);
Route::get('/companies/{company}', [CompanyController::class, 'showCompany']);
//edit companies
Route::get('/companies/{company}/edit', [CompanyController::class, 'editCompany']);
Route::post('/companies/{company}/edit', [CompanyController::class, 'handleEditCompany']);
//singular
//add companies
Route::get('/company/add', [CompanyController::class, 'addCompany']);
Route::post('/company/add', [CompanyController::class, 'handleAddCompany']);
Route::get('/company/update/{id}', [CompanyController::class, 'updateCompany']);
Route::post('/company/update/{id}', [CompanyController::class, 'handleUpdateCompany']);

/* --- internships --- */
//filter
//Route::post('/', [InternshipController::class, 'searchInternships']);  //temp deleted to make it via ajax
Route::post('/ajaxSearchInternshipCall', [InternshipController::class, 'searchInternships']);
//plural
Route::get('/companies/{company}/internships/{internship}', [InternshipController::class, 'showInternship']);
Route::get('/companies/{company}/internships/{internship}/edit', [InternshipController::class, 'editInternship']);
Route::post('/companies/{company}/internships/{internship}/edit', [InternshipController::class, 'handleEditInternship']);
Route::get('/companies/{company}/internships/{internship}/delete', [InternshipController::class, 'deleteInternship']);
Route::post('/companies/{company}/internships/{internship}/delete', [InternshipController::class, 'handleDeleteInternship']);
Route::post('/companies/{company}', [InternshipController::class, 'addInternshipOffer']);
//singular
Route::get('/company/addInternship/{id}', [InternshipController::class, 'addInternship']);
Route::post('/company/addInternship/{id}', [InternshipController::class, 'handleAddInternship']);

/* --- applications --- */
Route::get('/user/applications', [ApplicationController::class, 'showApplications']);
Route::get('/companies/{company}/internships/{internship}/applications/add', [ApplicationController::class, 'addApplication']);
Route::post('/companies/{company}/internships/{internship}/applications/add', [ApplicationController::class, 'handleAddAplication']);
Route::get('/company/{company}/applications/edit/{application}', [ApplicationController::class, 'editApplication']);
Route::post('/company/{company}/applications/edit/{application}', [ApplicationController::class, 'handleEditAplication']);
