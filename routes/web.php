<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;

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
// Route::get('/', [HomeController::class, 'index']);
// Route::get('/', [PDFController::class, 'index'])->name('home');
// Route::get('/user/search', [UserController::class, 'searchUser'])->name('user.search');
// Route::post('/download', [UserController::class, 'download'])->name('user.download');
// Route::get('/generate-invitation-pdf/{recipientName}/{electionDate}', [InvitationController::class, 'generateInvitationPdf'])->name('generate.invitation.pdf');
// Route::get('fill-data-pdf', [InvitationController::class,'HomeController@index']);

// Use HomeController for the root path
Route::get('/', [HomeController::class, 'index'])->name('home');

// Use PDFController for generating PDF
Route::get('/pdf', [PDFController::class, 'index'])->name('pdf');

// Use UserController for user search
Route::get('/user/search', [UserController::class, 'searchUser'])->name('user.search');

