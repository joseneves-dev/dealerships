<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middlewares\CheckAdmin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DealershipsController;
use App\Http\Controllers\ContractsController;

Route::get('/', function () {
    return redirect()->route('login');  // Redirect to the login page
});

// Login Route
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Forgot Password Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [MainController::class, 'home'])->name('home');

Route::get('/info', [MainController::class, 'info'])->name('info')->middleware(CheckAdmin::class . ':false');


Route::prefix('/contracts')->group(function () {
    // New Contract
    Route::get('/new', [ContractsController::class, 'showNewForm'])->name('newContract');
    Route::post('/new', [ContractsController::class, 'new'])->name('newContractEntry');

    //Filter
    Route::get('/filter', [ContractsController::class, 'filter'])->name('filter');

    //PDF
    Route::get('/{contractId}/pdf', [ContractsController::class, 'generatePdf'])->name('contractPdf');

    // Edit Contract
    Route::get('/{id}/edit', [ContractsController::class, 'showEditForm'])->name('contractEdit');
    Route::post('/{id}/edit', [ContractsController::class, 'edit'])->name('contractEdit');

    //Cancel Contract
    Route::get('/cancel/{id}', [ContractsController::class, 'cancel'])->name('contractCancel');
});

Route::middleware(CheckAdmin::class . ':true')->group(function () {
    Route::prefix('/dealerships')->group(function () {

        // View all dealerships
        Route::get('/view', [DealershipsController::class, 'view'])->name('viewDealerships');

        // New Dealership
        Route::get('/new', [DealershipsController::class, 'showNewForm'])->name('newDealership');
        Route::post('/new', [DealershipsController::class, 'new'])->name('newDealershipEntry');

        // Edit 
        Route::get('/{id}/edit', [DealershipsController::class, 'showEditForm'])->name('editDealership');
        Route::post('/{id}/edit', [DealershipsController::class, 'edit'])->name('editDealershipEntry');
    });
});
