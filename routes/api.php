<?php

use App\Http\Controllers\CarServiceController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ContactController;
use \App\Http\Controllers\RelationCategoryController;
use \App\Http\Controllers\ProductCategoryController;
use \App\Http\Controllers\RelationController;
use \App\Http\Controllers\PermissionController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ProductSerialNumberController;
use \App\Http\Controllers\RepresentationController;
use \App\Http\Controllers\BoxController;

Route::prefix('auth')->group(function () {
    Route::post('/check', function () {
    })->middleware("auth:sanctum");
    Route::post('/sign-o', [OrganizationController::class, "sign"]);
    Route::post('/sign-c', [CarServiceController::class, "sign"]);
});


Route::post('product_serial_numbers_between', [ProductSerialNumberController::class, "autoBarcode"])->middleware(['web', 'auth']);

Route::get('/user-permissions/{user}', [PermissionController::class, 'userPermissions'])->middleware(['web', 'auth']);;
Route::post('/user-permissions/{user}', [PermissionController::class, 'updateUserPermissions'])->middleware(['web', 'auth']);;


Route::get("/optimize", function () {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    \Illuminate\Support\Facades\Artisan::call("optimize", [], $output);

    dd($output->fetch());
});


Route::apiResource('users', UserController::class)->middleware(['web', 'auth']);
Route::apiResource('contacts', ContactController::class)->middleware(['web', 'auth']);
Route::apiResource('relation_categories', RelationCategoryController::class)->middleware(['web', 'auth']);
Route::apiResource('relations', RelationController::class)->middleware(['web', 'auth']);
Route::apiResource('product_categories', ProductCategoryController::class)->middleware(['web', 'auth']);
Route::apiResource('products', ProductController::class)->middleware(['web', 'auth']);
Route::apiResource('product_serial_numbers', ProductSerialNumberController::class)->middleware(['web', 'auth']);
Route::apiResource('representations', RepresentationController::class)->middleware(['web', 'auth']);
Route::apiResource('boxes', BoxController::class)->middleware(['web', 'auth']);
Route::apiResource('organizations', OrganizationController::class)->middleware(['web', 'auth']);
Route::apiResource('carServices', CarServiceController::class)->middleware(['web', 'auth']);
