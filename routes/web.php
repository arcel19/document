<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LogHistoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    'status',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('document', DocumentController::class);
    Route::get('/inbound',[DocumentController::class, 'inbound'])->name('inbound')->middleware('status');
    Route::get('/outbound',[DocumentController::class, 'outbound'])->name('outbound');
    Route::post('/send/{id}', [DocumentController::class, 'sendDoc'])->name('send');
    Route::put('/state/{user}',[UserController::class, 'state'])->name('state');
    Route::resource('user', UserController::class);
    Route::get('logs-history',[UserController::class,'logIndex'])->name('logIndex');
    Route::get('delete-all-log', [LogHistoryController::class, "deleteAllLogs"])->name('delete-all-log');
    Route::get('log',[\App\Models\User::class,'logUserActivity']);

})->middleware('status');

