<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth
Auth::routes();

// Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('/', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');


    Route::middleware(['auth.admin'])->group(function () {
        // Dashboard
       Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Pages
        Route::resource('/pages', 'PagesController');
        Route::put('/pages/{id}/status', 'PagesController@status')->name('pages.status');

        // Categories
        Route::resource('/categories', 'CategoriesController');
        Route::put('/categories/{id}/status', 'CategoriesController@status')->name('categories.status');

        // Products
        Route::resource('/products', 'ProductsController');
        Route::put('/products/{id}/status', 'ProductsController@status')->name('products.status');

        // Users
        Route::get('/users', 'UsersController@index')->name('users.index');
        Route::put('/users/{id}/status', 'UsersController@status')->name('users.status');

        // Profile
        Route::get('/users/{id}/profile', 'ProfileController@edit')->name('profile.edit');
        Route::put('/users/{id}/profile', 'ProfileController@update')->name('profile.update');

        // IP's
        Route::get('/users/{id}/ips', 'IpsController@edit')->name('ips.edit');
        Route::put('/users/{id}/ips', 'IpsController@update')->name('ips.update');

        // Orders
        Route::get('/users/{id}/orders', 'OrdersController@index')->name('orders.index');
        Route::get('/users/{user}/orders/{order}', 'OrdersController@edit')->name('orders.edit');
        Route::put('/users/{user}/orders/{order}', 'OrdersController@update')->name('orders.update');
        Route::put('/users/{id}/orders/{order}/status', 'OrdersController@status')->name('orders.status');

        // File manager
        Route::namespace('FileManager')->prefix('filemanager')->name('filemanager.')->group(function () {
            Route::get('/', 'FileManagerController@index')->name('index');
            Route::post('/', 'CreateController@store')->name('store');
            Route::post('/upload', 'UploadController@upload')->name('upload');
            Route::put('/rename', 'RenameController@rename')->name('rename');
            Route::post('/download', 'DownloadController@download')->name('download');
            Route::delete('/delete', 'DeleteController@delete')->name('delete');
        });
    });
});

// Profile
Route::middleware(['auth'])->namespace('Profile')->prefix('profile')->name('profile.')->group(function () {
    // Profile
    Route::name('user.')->group(function () {
        Route::get('/', 'UsersController@edit')->name('edit');
        Route::put('/', 'UsersController@update')->name('update');
    });

    // Orders
    Route::resource('/orders', 'OrdersController');
});
