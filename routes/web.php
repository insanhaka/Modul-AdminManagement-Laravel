<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SectorController;

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

Route::get('/login', [AuthorizeController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthorizeController::class, 'postlogin']);
Route::get('/signup', [AuthorizeController::class, 'signup'])->name('signup');
Route::post('/postsignup', [AuthorizeController::class, 'postsignup']);
Route::get('/notactive', [AuthorizeController::class, 'notactive'])->name('notactive');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    
    Route::get('/logout', [AuthorizeController::class, 'logout']);

    Route::get('/', [HomeController::class, 'index'])->name('home');

    //Route Untuk Super Admin
    Route::get('/user/dashboard', [UsersController::class, 'index'])->name('admin');
    Route::get('/user/{id}/profile', [UsersController::class, 'profile']);
    Route::get('/user/view', [UsersController::class, 'view']);
    Route::get('/user/view/{id}/edit', [UsersController::class, 'edit']);
    Route::post('/user/view/{id}/update', [UsersController::class, 'update']);
    Route::get('/user/view/{id}/delete', [UsersController::class, 'delete']);
    Route::post('/user/activation', [UsersController::class, 'activation']);

    Route::get('/user/roles', [RolesController::class, 'view'])->name('roles');
    Route::get('/user/roles/add', [RolesController::class, 'add']);
    Route::post('/user/roles/create', [RolesController::class, 'create']);
    Route::get('/user/roles/{id}/edit', [RolesController::class, 'edit']);
    Route::post('/user/roles/{id}/update', [RolesController::class, 'update']);
    Route::get('/user/roles/{id}/delete', [RolesController::class, 'delete']);

    Route::get('/user/permission', [PermissionController::class, 'view'])->name('permission');
    Route::get('/user/permission/add', [PermissionController::class, 'add']);
    Route::post('/user/permission/create', [PermissionController::class, 'create']);
    Route::get('/user/permission/{id}/show', [PermissionController::class, 'show']);
    Route::get('/user/permission/{id}/edit', [PermissionController::class, 'edit']);
    Route::post('/user/permission/{id}/update', [PermissionController::class, 'update']);
    Route::get('/user/permission/{id}/delete', [PermissionController::class, 'delete']);

    Route::get('/user/menu', [MenuController::class, 'view'])->name('menu');
    Route::get('/user/menu/add', [MenuController::class, 'add']);
    Route::post('/user/menu/create', [MenuController::class, 'create']);
    Route::get('/user/menu/{id}/edit', [MenuController::class, 'edit']);
    Route::post('/user/menu/{id}/update', [MenuController::class, 'update']);
    Route::get('/user/menu/{id}/delete', [MenuController::class, 'delete']);
    Route::post('/menu/activation', [MenuController::class, 'activation']);

    //Route Untuk Admin Lain (Sesuai Menu)
    Route::get('/business-sector', [SectorController::class, 'view'])->name('business-sector');
    Route::get('/business-sector/add', [SectorController::class, 'add']);
    Route::post('/business-sector/create', [SectorController::class, 'create']);
    Route::get('/business-sector/edit/{id}', [SectorController::class, 'edit']);
    Route::post('/business-sector/update/{id}', [SectorController::class, 'update']);
    Route::get('/business-sector/delete/{id}', [SectorController::class, 'delete']);

    Route::get('/business', [BusinessController::class, 'view'])->name('business');
    Route::get('/business/add', [BusinessController::class, 'add']);
    Route::post('/business/create', [BusinessController::class, 'create']);
    Route::get('/business/edit/{id}', [BusinessController::class, 'edit']);
    Route::post('/business/update/{id}', [BusinessController::class, 'update']);
    Route::get('/business/delete/{id}', [BusinessController::class, 'delete']);

});
