<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\LiveUser;
use App\Http\Livewire\LiveCompany;
use App\Http\Livewire\LiveFacility;
use App\Http\Livewire\LiveRegion;
use App\Http\Livewire\LiveDisplay;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DisplayTypeController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [HomeController::class, 'index'])  ->name('home');

    #Livewire Route
    Route::get('/user',                 LiveUser::class)          ->name('livewire.user')       ->middleware ('role:Platform Admin|Regional Admin|Corporate Admin|Facility Admin');
    Route::get('/',                     LiveCompany::class)       ->name('livewire.company')    ->middleware ('auth');
    Route::get('/facilities/{company}', LiveFacility::class)      ->name('livewire.facility')   ->middleware ('auth');
    Route::get('/regions',              LiveRegion::class)        ->name('livewire.region')     ->middleware ('auth');
    Route::get('/displays',             LiveDisplay::class)       ->name('livewire.display')    ->middleware ('auth');













    
    // Route::get('/menus',                LiveMenu::class)          ->name('livewire.menu');

    // #User Routes
    // Route::get('/create/user',                            [UserController::class, 'create'])          ->name('user.create');
    // Route::post('/create/user',                           [UserController::class, 'store'])           ->name('user.store');

    // #Company Routes
    // Route::get('/',                                       [CompanyController::class, 'index'])        ->name('company.index') ->middleware ('role:Platform Admin|Corporate Admin|Regional Admin|Facility Admin|Facility Editor');
    // Route::get('/create',                                 [CompanyController::class, 'create'])       ->name('company.create')->middleware ('role:Platform Admin|Corporate Admin|Regional Admin');
    // Route::post('/company' ,                              [CompanyController::class, 'store'])        ->name('company.create')->middleware ('role:Platform Admin|Corporate Admin|Regional Admin');
    // Route::get('/{company}',                              [CompanyController::class, 'edit'])         ->name('company.edit')  ->middleware ('role:Platform Admin|Corporate Admin|Regional Admin');
    // Route::post('/{company}',                             [CompanyController::class, 'update'])       ->name('company.update')->middleware ('role:Platform Admin|Corporate Admin|Regional Admin');
    // Route::delete('/{company}',                           [CompanyController::class, 'destroy'])      ->name('company.delete')->middleware ('role:Platform Admin|Corporate Admin|Regional Admin');


    // #Facility Routes 
    // Route::get('company/facility/{company}',              [FacilityController::class, 'index'])       ->name('facility.index');
    // Route::get('/create/facility/{company}',              [FacilityController::class, 'create'])      ->name('facility.create');
    // Route::post('/create/facility/{company}',             [FacilityController::class, 'store'])       ->name('facility.store');
    // Route::get('/edit/facility/{facility}',               [FacilityController::class, 'edit'])        ->name('facility.edit');
    // Route::post('/update/facility/{facility}',            [FacilityController::class, 'update'])      ->name('facility.update');
    // Route::delete('/destroy/facility/{facility}',         [FacilityController::class, 'destroy'])     ->name('facility.destroy');       

    // #Display Type Routes
    // Route::get('/display-types/all',                      [DisplayTypeController::class, 'index'])    ->name('display.index');
    // Route::get('/display-type/create',                    [DisplayTypeController::class, 'create'])   ->name('display.create');
    // Route::post('/display-type/store',                    [DisplayTypeController::class, 'store'])    ->name('display.store');
    // Route::get('/display-type/edit/{displayType}',        [DisplayTypeController::class, 'edit'])     ->name('display.edit');
    // Route::post('/display-type/{displayType}',            [DisplayTypeController::class, 'update'])   ->name('display.update');
    // Route::delete('/display-type/{displayType}/destroy',  [DisplayTypeController::class, 'destroy'])  ->name('display.destroy');

    // #Region Routes
    // Route::get('/regions/all',                            [RegionController::class, 'index'])         ->name('region.index');
    // Route::get('/region/create',                          [RegionController::class, 'create'])        ->name('region.create');
    // Route::post('/region/store',                          [RegionController::class, 'store'])         ->name('region.store');
    // Route::get('/region/edit/{region}',                   [RegionController::class, 'edit'])          ->name('region.edit');
    // Route::post('/region/{region}',                       [RegionController::class, 'update'])        ->name('region.update');
    // Route::delete('/region/{region}/destroy',             [RegionController::class, 'destroy'])       ->name('region.destroy');

    // Route::get('/', function () {
    //     if(auth()->user()){
    //         auth()->user()->assginRole('admin');
    //     }
    //     return redirect()->route('index');
    // })->name('/');

    // Route::prefix('starter-kit')->group(function () {
    //     Route::view('index', 'admin.color-version.index')->name('index');
    // });







    
