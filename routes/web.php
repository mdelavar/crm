<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/o-panel', function () {
    return Inertia::render('OrganizationPanel/Main');
})->name('organizationPanel');

Route::group(['prefix' => "dashboard", "middleware" => 'auth'], function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::get('/users', function () {
        return Inertia::render('Users/Main');
    })->name('users');

    Route::get('/contacts', function () {
        return Inertia::render('Contacts/Main');
    })->name('contacts');

    Route::get('/relation_category', function () {
        return Inertia::render('RelationCategory/Main');
    })->name('relation_category');

    Route::get('/relations', function () {
        return Inertia::render('Relations/Main');
    })->name('relations');

    Route::get('/product_category', function () {
        return Inertia::render('ProductCategory/Main');
    })->name('product_category');

    Route::get('/products', function () {
        return Inertia::render('Products/Main');
    })->name('products');

    Route::get('/product_serials', function () {
        return Inertia::render('ProductSerial/Main');
    })->name('product_serials');

    Route::get('/representations', function () {
        return Inertia::render('Representations/Main');
    })->name('representations');

    Route::get('/boxes', function () {
        return Inertia::render('Box/Main');
    })->name('boxes');

    Route::get('/organizations', function () {
        return Inertia::render('Organization/Main');
    })->name('organizations');

    Route::get('/car_services', function () {
        return Inertia::render('CarService/Main');
    })->name('car_services');
});

Route::get('public_path' , function () {
   return public_path();
});

require __DIR__ . '/auth.php';
