<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\User\UserIndex;
use App\Http\Livewire\Region\RegionIndex;
use App\Http\Livewire\Display\DisplayIndex;
use App\Http\Livewire\Company\CompanyIndex;
use App\Http\Livewire\Banner\BannerComponent;
use App\Http\Livewire\Facility\FacilityIndex;
use App\Http\Livewire\Facility\Settings\FacilitySetting;
use App\Http\Livewire\Banner\BannerDropzone;
// use App\Http\Controllers\DropzoneController;


use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [HomeController::class, 'index'])  ->name('home');

Route::post('dropzone/upload/{id}', [BannerDropzone::class, 'upload'])->name('dropzone.upload');
// Route::post('dropzone/upload/{id}', [DropzoneController::class, 'upload'])->name('dropzone.upload');

Route::view('/updates', 'update.index');

    #Livewire Routes
    Route::get('/',                     CompanyIndex::class)          ->name('livewire.company')    ->middleware ('auth');
    Route::get('/facilities/{company}', FacilityIndex::class)         ->name('livewire.facility')   ->middleware ('auth');
    Route::get('/banners/{company}',    BannerComponent::class)       ->name('livewire.banner')     ->middleware ('auth');
    Route::get('/displays',             DisplayIndex::class)          ->name('livewire.display')    ->middleware ('auth');
    Route::get('/regions',              RegionIndex::class)           ->name('livewire.region')     ->middleware ('auth');
    Route::get('/users',                UserIndex::class)             ->name('livewire.user')       ->middleware ('role:Platform Admin|Regional Admin|Corporate Admin|Facility Admin');  

    Route::get('/facility/{facility}',  FacilitySetting::class)       ->name('livewire.setting')    ->middleware ('auth');






    
