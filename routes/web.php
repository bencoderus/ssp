<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('campaigns')->name('campaign.')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [CampaignController::class, 'index'])->name('index');
    Route::get('create', [CampaignController::class, 'create'])->name('create');
    Route::get('{campaign:code}/edit', [CampaignController::class, 'edit'])->name('edit');
    Route::post('store', [CampaignController::class, 'store'])->name('store');
    Route::patch('{campaign:code}/update', [CampaignController::class, 'update'])->name('update');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
