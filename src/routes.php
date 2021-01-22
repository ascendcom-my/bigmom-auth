<?php

use Bigmom\Auth\Http\Middleware\RedirectIfAuthenticated;
use Bigmom\Auth\Http\Controllers\AuthController;
use Bigmom\Auth\Http\Controllers\PermissionController;
use Bigmom\Auth\Http\Middleware\EnsureUserIsAuthorized;
use Bigmom\Auth\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('bigmom')->name('bigmom-auth.')->middleware(['web'])->group(function () {
    Route::middleware([Authenticate::class, EnsureUserIsAuthorized::class.':auth-access'])->group(function () {
        Route::get('/', [AuthController::class, 'getHome'])->name('getHome');
        Route::middleware([EnsureUserIsAuthorized::class.':auth-manage'])->group(function () {
            Route::prefix('permission')->name('permission.')->group(function () {
                Route::get('/index', [PermissionController::class, 'getIndex'])->name('getIndex');
                Route::post('/create', [PermissionController::class, 'postCreate'])->name('postCreate');
                Route::post('/delete', [PermissionController::class, 'postDelete'])->name('postDelete');
            });
        });
        Route::post('/logout', [AuthController::class, 'postLogout'])->name('postLogout');
    });
    Route::middleware([RedirectIfAuthenticated::class])->group(function () {
        Route::get('/login', [AuthController::class, 'getLogin'])->name('getLogin');
        Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    });
});