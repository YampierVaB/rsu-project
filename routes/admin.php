<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\BrandModelController;
use Illuminate\Support\Facades\Route;


Route::resource('/', AdminController::class)->names('admin');
// Registrar todas las rutas del recurso BrandController
Route::resource('brands', BrandController::class)->names('admin.brands');
Route::resource('models', BrandmodelController::class)->names('admin.models');