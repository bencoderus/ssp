<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\HomeController;
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

// Campaign Routes.
Route::prefix('campaigns')->name('campaign.')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [CampaignController::class, 'index'])->name('index');
    Route::get('create', [CampaignController::class, 'create'])->name('create');
    Route::get('{campaign:code}/edit', [CampaignController::class, 'edit'])->name('edit');
    Route::post('store', [CampaignController::class, 'store'])->name('store');
    Route::patch('{campaign:code}/update', [CampaignController::class, 'update'])->name('update');
    Route::delete('images/{image}/delete', [CampaignController::class, 'deleteImage'])->name('image.delete');
});

// Dashboard Routes.
Route::get('/', [HomeController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
