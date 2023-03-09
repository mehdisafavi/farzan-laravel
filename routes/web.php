<?php

use App\Http\Controllers\BikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('main');
});*/

Route::get('/', [BikeController::class, 'main'])->name('main.bikes');
Route::get('/bike/{bike_id}', [BikeController::class, 'view'])->name('bike.view');


Route::group(['middleware' => ['auth', 'verified'],'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/bikes', [BikeController::class, 'index'])->name('dashboard.bikes');
    Route::post('/bikes', [BikeController::class, 'new_bike'])->name('dashboard.bikes.new');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
