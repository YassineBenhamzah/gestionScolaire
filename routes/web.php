<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NiveauScolaireController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get("/login" , [AuthController::class , 'showLogin'])
        ->middleware("guest")
        ->name("login");

Route::post("/login" , [AuthController::class , 'authenticate'])
        ->middleware("guest")
        ->name("login.post");

Route::group([
    "middleware" => "auth"
] , function(){
    Route::get('/', function () {
        return inertia('Home');
    })->name("home");

    Route::post("/logout" , [AuthController::class , 'logout'])->name("logout");

    Route::get('/etudiant', [EtudiantController::class , 'index'])->name("etudiant.index");
    Route::get('/etudiant/create', [EtudiantController::class , 'create'])->name("etudiant.create");
    Route::post('/etudiant', [EtudiantController::class , 'store'])->name("etudiant.store");
    Route::get('/etudiant/edit/{etudiant}', [EtudiantController::class , 'edit'])->name("etudiant.edit");
    Route::post('/etudiant/{etudiant}', [EtudiantController::class , 'update'])->name("etudiant.update");
    Route::delete('/etudiant/{etudiant}', [EtudiantController::class , 'delete'])->name("etudiant.delete");




    Route::get('/niveauscolaire', [NiveauScolaireController::class , 'index'])->name("niveauscolaire.index");
    Route::post('/niveauscolaire', [NiveauScolaireController::class , 'store'])->name("niveauscolaire.store");
    Route::get('/niveauscolaire/edit/{niveauScolaire}', [NiveauScolaireController::class , 'edit'])->name("niveauscolaire.edit");
    Route::put('/niveauscolaire/{niveauScolaire}', [NiveauScolaireController::class , 'update'])->name("niveauscolaire.update");
    Route::delete('/niveauscolaire/{niveauScolaire}', [NiveauScolaireController::class , 'delete'])->name("niveauscolaire.delete");
});







/* Route::get('/niveauscolaire/create', [NiveauScolaireController::class , 'create'])->name("niveauscolaire.create"); */


/* Route::get('customers/create' , [CustomerController::class,'create']);
Route::post('customers' , [CustomerController::class,'store']);
Route::get('customers' , [CustomerController::class,'index'])->name('customers.index');
Route::delete('customers/{customer}' , [CustomerController::class,  'destroy']);
Route::get('customers/{customer}/edit' , [CustomerController::class,'edit'])->name('customers.edit');
Route::put('customers/{customer}' , [CustomerController::class,'update'])->name('customers.edit'); */
