<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\User\UserIndex;
use App\Http\Livewire\Region\RegionIndex;
use App\Http\Livewire\Display\DisplayIndex;
use App\Http\Livewire\Company\CompanyIndex;
use App\Http\Livewire\Banner\BannerLivewire;
use App\Http\Livewire\Facility\FacilityIndex;

use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [HomeController::class, 'index'])  ->name('home');

Route::view('/updates', 'update.index');
    #Livewire Routes
    Route::get('/',                     CompanyIndex::class)          ->name('livewire.company')    ->middleware ('auth');
    Route::get('/facilities/{company}', FacilityIndex::class)         ->name('livewire.facility')   ->middleware ('auth');
    Route::get('/banners/{company}',    BannerLivewire::class)        ->name('livewire.banner')     ->middleware ('auth');
    Route::get('/displays',             DisplayIndex::class)          ->name('livewire.display')    ->middleware ('auth');
    Route::get('/regions',              RegionIndex::class)           ->name('livewire.region')     ->middleware ('auth');
    Route::get('/users',                UserIndex::class)             ->name('livewire.user')       ->middleware ('auth');  







    
