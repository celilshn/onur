<?php

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

Route::get('/', function () {
    return redirect('homepage');
});
Route::get('/vue', function () {
    return view('app');
});

Route::get('/homepage', [\App\Http\Controllers\HomepageController::class, 'index'])->name("homepage");
Route::get('/getSurgeonsWithSectorOperationId', [\App\Http\Controllers\SectorOperationController::class, 'getSurgeonsWithSectorOperationId'])->name("getSurgeonsWithSectorOperationId");
Route::get('/sector', [\App\Http\Controllers\SectorController::class, 'index'])->name("sector");
Route::get('/sector_operation', [\App\Http\Controllers\SectorOperationController::class, 'index'])->name("sector_operation");
Route::get('/operation', [\App\Http\Controllers\OperationController::class, 'index'])->name("operation");
Route::get('/surgeon', [\App\Http\Controllers\SurgeonController::class, 'index'])->name("surgeon");

Route::post('/addSector', [\App\Http\Controllers\SectorController::class, 'addSector'])->name("addSector");
Route::post('/addSectorOperation', [\App\Http\Controllers\SectorOperationController::class, 'addSectorOperation'])->name("addSectorOperation");
Route::post('/addSurgeon', [\App\Http\Controllers\SurgeonController::class, 'addSurgeon'])->name("addSurgeon");
Route::post('/addOperation', [\App\Http\Controllers\OperationController::class, 'addOperation'])->name("addOperation");

Route::delete('/deleteOperation', [\App\Http\Controllers\OperationController::class, 'deleteOperation'])->name("deleteOperation");
Route::delete('/deleteSurgeonFromSectorOperation', [\App\Http\Controllers\SectorOperationController::class, 'deleteSurgeonFromSectorOperation'])->name("deleteSurgeonFromSectorOperation");
Route::delete('/deleteSector', [\App\Http\Controllers\SectorController::class, 'deleteSector'])->name("deleteSector");
Route::delete('/deleteSurgeon', [\App\Http\Controllers\SurgeonController::class, 'deleteSurgeon'])->name("deleteSurgeon");

Route::post('/addSurgeonToSectorOperation', [\App\Http\Controllers\SectorOperationController::class, 'addSurgeonToSectorOperation'])->name("addSurgeonToSectorOperation");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
