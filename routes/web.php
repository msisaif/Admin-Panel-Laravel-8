<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::view('/', 'dashboard')->name('dashboard');

    //Resource Routes
    Route::resources([
        'admins'        => AdminController::class,
        'roles'         => RoleController::class,
    ]);
});
