<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaissesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\MaterielsController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ParametresController;
use App\Http\Controllers\DecaissementController;
use App\Http\Controllers\EncaissementController;
use App\Http\Controllers\HomeController;

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
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/**
 * 
 * Parametres de l'application
 * 
 * */ 

Route::get('/parametres/personnel', [ParametresController::class, 'personnel'])->name('parametres.personnel');
Route::post('/parametres/savePersonnel', [PersonnelController::class, 'store'])->name('save.personnel');

Route::get('/parametres/applications', [ParametresController::class, 'applications'])->name('parametres.application');
Route::post('/parametres/saveNewServices', [ServicesController::class, 'store'] )->name('save.service');

Route::post('/parametres/saveNewMateriel', [MaterielsController::class, 'store'])->name('save.materiels');

Route::get('/parametres/caisses', [ParametresController::class, 'caisses'])->name('parametres.caisse');
Route::post('/parametre/saveDefaultCaisse', [CaissesController::class, 'store'])->name('save.default.caisse');


/**
 * 
 * Caisses
 * 
 * */ 
Route::get('caisse/encaissement', [EncaissementController::class, 'index'])->name('encaissement');
Route::get('caisse/decaissement', [DecaissementController::class, 'decaissement'])->name('decaissement');
Route::post('caisse/save_decaissement', [DecaissementController::class, 'store'])->name('save.decaissement');
Route::get('caisse/livre_caisse', [CaissesController::class, 'livreCaisse'])->name('livreCaisse');

/**
 * 
 * Payement
 * 
 * */ 
Route::post('caisse/debut_journey', [EncaissementController::class, 'storeDebutJournee'])->name('debutJourney');
Route::post('caisse/fin_journey', [EncaissementController::class, 'storeFinJournee'])->name('finJourney');
Route::get('caisse/payement', [PayementController::class, 'payement'])->name('payement');
Route::post('caisse/savePayement', [PayementController::class, 'store'])->name('save.payement');
Route::post('caisse/savePayement/Multiple', [PayementController::class, 'storeMultiple'])->name('save.payement.mutiple');
Route::post('caisse/payed', [PayementController::class, 'storePayed'])->name('payed.payement');


/**
 * 
 * Materiel & Stock
 * 
 * */ 

Route::get('/Magasin/stock', [MaterielsController::class, 'stock'])->name('stock');
Route::get('/Magasin/etat_stock', [MaterielsController::class, 'etatStock'])->name('etatStock');

 
/**
 * 
 * Ressources Hummaine
 * 
 * */ 

Route::get('/Rh/listePersonnel', [PersonnelController::class, 'listePersonnel'])->name('personnel.liste');
Route::get('/Rh/payementPersonnel', [PersonnelController::class, 'payementPersonnel'])->name('personnel.payement');
Route::post('/Rh/savePersonnel', [PersonnelController::class, 'storePersonnel'])->name('personnel.save');
Route::post('/Rh/savePayementPersonnel', [PersonnelController::class, 'payementStorePersonnel'])->name('payement.personnel');
Route::post('/Rh/payementValidate', [PersonnelController::class, 'validatePayement'])->name('payement.validate');


/**
 * AutocompleteController
 * 
 * */ 

 Route::get('/autocomplete', 'AutocompleteController@search');




