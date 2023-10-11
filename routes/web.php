<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::get('/user/{id}', function ($id) {
    return view('welcome', [ 'id' => $id ]);
});

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/create-user/{name}/{password}/{email}', [UserController::class, 'create_user']);

Route::get('/dashboard/login', [AdminController::class,'login'])->name('dashboard.login');
Route::controller(AdminController::class)->middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/admin-panel', 'index')->name('dashboard');
    Route::get('/index2', 'index2')->name('index2');
    Route::get('/child', 'child')->name('child');
    Route::get('/profile', 'profile')->name('dashboard.profile');
    Route::post('/update-profile', 'updateProfile')->name('updateProfile');
    Route::get('/logout', 'logout')->name('dashboard.logout');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/locale/{locale}', [AdminController::class, 'locale']);

Route::get('/locale', function(){
    return app()->getLocale();
});

Route::get('/test', function(){
    $hashedValue = \Hash::make('123456789');
    $array = [
        'md5' => md5('123456789'),
        'hash' => $hashedValue,
        'check_hash' => \Hash::check('123456789', $hashedValue),
        'public_path' => public_path()
    ];
    return $array;
});


// I am B

// I am A

