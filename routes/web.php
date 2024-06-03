<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

//Route::get('/', function (){
//    return view('index');
//})->name('index');

Route::get('/', [CompanyController::class, 'index'])->name('index');
Route::get('/company', [CompanyController::class, 'create'])->name('company.create');
Route::post('/company', [CompanyController::class, 'store'])->name('company.store');

