<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\socialMediaLoginController;
use App\Http\LoginController;

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

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//  goole login
Route::get('login/google', [socialMediaLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [socialMediaLoginController::class, 'handleGoogleCallback']);


// login facebook
Route::get('login/facebook', [socialMediaLoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [socialMediaLoginController::class, 'handleFacebookCallback']);

// login twitter
Route::get('login/twitter', [socialMediaLoginController::class, 'redirectToTwitter'])->name('login.twitter');
Route::get('login/twitter/callback', [socialMediaLoginController::class, 'handleTwitterCallback']);

// login linkedin
Route::get('login/linkedin', [LoginController::class, 'redirectToLinkedin'])->name('login.linkedin');
Route::get('login/linkedin/callback', [LoginController::class, 'handleLinkedinCallback']);

// login github
Route::get('login/github', [socialMediaLoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [socialMediaLoginController::class, 'handleGithubCallback']);

