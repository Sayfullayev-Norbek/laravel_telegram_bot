<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyGroupController;

//Route::get('/', function (){
//    return view('index');
//})->name('index');

Route::get('/', [CompanyController::class, 'index'])->name('index');

Route::post('/dashboard', [CompanyController::class, "tariffCreate"])->name('tariff_create');

Route::get('/company', [CompanyController::class, 'create'])->name('company.create');
Route::post('/company', [CompanyController::class, 'store'])->name('company.store');

Route::get('/dashboard', [CompanyGroupController::class, 'companyCreate'])->name('companyCreate');

