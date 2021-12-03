<?php


use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Company\CompanyComponent;
use App\Http\Livewire\Facility\FacilityComponent;
use App\Http\Livewire\Display\DisplayComponent;
use App\Http\Livewire\Region\RegionComponent;
use App\Http\Livewire\User\UserComponent;


use App\Http\Livewire\LiveUser;
use App\Http\Livewire\LiveFacility;


use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [HomeController::class, 'index'])  ->name('home');

    #Livewire Route
    // Route::get('/user',                 LiveUser::class)          ->name('livewire.user')       ->middleware ('role:Platform Admin|Regional Admin|Corporate Admin|Facility Admin');
    // Route::get('/facilities/{company}', LiveFacility::class)      ->name('livewire.facility')   ->middleware ('auth');
    Route::get('/',                     CompanyComponent::class)      ->name('livewire.company')    ->middleware ('auth');
    Route::get('/facilities/{company}', FacilityComponent::class)     ->name('livewire.facility')   ->middleware ('auth');
    Route::get('/displays',             DisplayComponent::class)      ->name('livewire.display')    ->middleware ('auth');
    Route::get('/regions',              RegionComponent::class)       ->name('livewire.region')     ->middleware ('auth');
    Route::get('/users',                 UserComponent::class)         ->name('livewire.user')       ->middleware ('auth');  







    
