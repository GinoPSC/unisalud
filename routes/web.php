<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClaveUnicaController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Home;

use App\Http\Controllers\Parameter\PermissionController;
use App\Http\Controllers\Profile\ProfileController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Profile\ObservationController;

use App\Http\Controllers\PatientController;

use App\Http\Controllers\MedicalProgrammer\OperatingRoomProgrammingController;
use App\Http\Controllers\MedicalProgrammer\ActivityController;


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

/* Grabar en Google storage  */
// $disk = \Storage::disk('gcs');
// $url = $disk->put('FILE.txt',"hola");

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Auth::routes();

Route::get('/claveunica', [ClaveUnicaController::class,'autenticar'])->name('claveunica');
Route::get('/claveunica/callback', [ClaveUnicaController::class,'callback']);
Route::get('/claveunica/callback-testing', [ClaveUnicaController::class,'callback']);
Route::get('/claveunica/logout', [ClaveUnicaController::class,'logout'])->name('claveunica.logout');

Route::get('/login/{run}', [ProfileController::class, 'login']);
Route::get('/logout', [ProfileController::class,'logout']);

/** Ejempo con livewire */
//Route::get('/home', Home::class)->middleware('auth')->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::prefix('parameter')->as('parameter.')->middleware('auth')->group(function () {
    Route::resource('permission', PermissionController::class);
});

Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::prefix('observation')->name('observation.')->group(function(){
        Route::get('/', [ObservationController::class, 'index'])->name('index');
        Route::get('/download/{id}', [ObservationController::class, 'download'])->name('download');
    });
});

Route::prefix('user')->name('user.')->middleware('auth')->group(function(){
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
});
Route::prefix('patient')->name('patient.')->middleware('auth')->group(function(){
    Route::get('/', [PatientController::class, 'index'])->name('index');
    Route::post('/', [PatientController::class, 'store'])->name('store');
    Route::get('/create', [PatientController::class, 'create'])->name('create');
    Route::get('/{patient}', [PatientController::class, 'show'])->name('show');
    Route::put('/{patient}', [PatientController::class, 'update'])->name('update');
    Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('destroy');
    Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('edit');
});

Route::prefix('medical_programmer')->name('medical_programmer.')->middleware('auth')->group(function(){
  Route::prefix('operating_room_programming')->name('operating_room_programming.')->group(function(){
    Route::get('/', [OperatingRoomProgrammingController::class, 'index'])->name('index');
    Route::post('/', [OperatingRoomProgrammingController::class, 'store'])->name('store');
    Route::get('/create', [OperatingRoomProgrammingController::class, 'create'])->name('create');
    Route::get('/{patient}', [OperatingRoomProgrammingController::class, 'show'])->name('show');
    Route::put('/{patient}', [OperatingRoomProgrammingController::class, 'update'])->name('update');
    Route::delete('/{patient}', [OperatingRoomProgrammingController::class, 'destroy'])->name('destroy');
    Route::get('/{patient}/edit', [OperatingRoomProgrammingController::class, 'edit'])->name('edit');

    Route::get('saveMyEvent', [OperatingRoomProgrammingController::class, 'saveMyEvent'])->name('saveMyEvent');
    Route::get('updateMyEvent', [OperatingRoomProgrammingController::class, 'updateMyEvent'])->name('updateMyEvent');
    Route::get('deleteMyEvent', [OperatingRoomProgrammingController::class, 'deleteMyEvent'])->name('deleteMyEvent');
    Route::get('deleteMyEventForce', [OperatingRoomProgrammingController::class, 'deleteMyEventForce'])->name('deleteMyEventForce');
  });

  Route::prefix('activities')->name('activities.')->group(function(){
    Route::get('/', [ActivityController::class, 'index'])->name('index');
    Route::post('/', [ActivityController::class, 'store'])->name('store');
    Route::get('/create', [ActivityController::class, 'create'])->name('create');
    Route::get('/{activity}', [ActivityController::class, 'show'])->name('show');
    Route::put('/{activity}', [ActivityController::class, 'update'])->name('update');
    Route::delete('/{activity}', [ActivityController::class, 'destroy'])->name('destroy');
    Route::get('/{activity}/edit', [ActivityController::class, 'edit'])->name('edit');
  });
});

Route::view('/some', 'some');
Route::view('/crear_usuario', 'crear_usuario');
