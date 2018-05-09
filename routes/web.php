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
    return view('homepage');
})->name('homepage');

Auth::routes();

Route::get('/panel', 'HomeController@index')->name('panel');

Route::get('/{username}', 'UserController@show')->name('user.show');

Route::group(['prefix' => 'panel', 'middleware' => 'auth'], function() {
    // Main pages
    Route::get('', 'HomeController@index')->name('panel');
    Route::get('edit-account', 'HomeController@showAccount')->name('panel.editAccount');
    Route::post('edit-account', 'HomeController@editAccount')->name('panel.updateAccount');
    Route::get('trips', 'HomeController@trips')->name('panel.trips');
    Route::get('edit-trip/{id}', 'HomeController@showTrip')->name('panel.showTrip');
    
    Route::prefix('create')->group(function () {
        Route::get('category', 'CategoryController@create')->name('admin.category.create');
        Route::get('user', 'UserController@create')->name('admin.user.create');
        Route::get('media-type', 'MediaTypeController@create')->name('admin.mediaType.create');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    // Main pages
    Route::get('', 'HomeController@indexAdmin')->name('admin.index');
    Route::get('categories', 'CategoryController@indexAdmin')->name('admin.category.index');
    Route::get('users', 'UserController@indexAdmin')->name('admin.user.index');
    Route::get('media-types', 'MediaTypeController@indexAdmin')->name('admin.mediaType.index');

    Route::prefix('create')->group(function () {
        Route::get('category', 'CategoryController@create')->name('admin.category.create');
        Route::get('user', 'UserController@create')->name('admin.user.create');
        Route::get('media-type', 'MediaTypeController@create')->name('admin.mediaType.create');
    });

    Route::prefix('store')->group(function () {
        Route::post('category', 'CategoryController@store')->name('admin.category.store');
        Route::post('user', 'UserController@store')->name('admin.user.store');
        Route::post('media-type', 'MediaTypeController@store')->name('admin.mediaType.store');
    });

    Route::prefix('show')->group(function () {
        Route::get('category/{name}', 'CategoryController@showAdmin')->name('admin.category.show');
        Route::get('user/{username}', 'UserController@showAdmin')->name('admin.user.show');
        Route::get('media-type/{name}', 'MediaTypeController@showAdmin')->name('admin.mediaType.show');
    });

    Route::prefix('update')->group(function () {
        Route::post('category/{name}', 'CategoryController@update')->name('admin.category.update');
        Route::post('user/{username}', 'UserController@update')->name('admin.user.update');
        Route::post('media-type/{name}', 'MediaTypeController@update')->name('admin.mediaType.update');
    });

    Route::prefix('delete')->group(function () {
        Route::get('category/{name}', 'CategoryController@destroy')->name('admin.category.destroy');
        Route::get('user/{name}', 'UserController@destroy')->name('admin.user.destroy');
        Route::get('media-type/{name}', 'MediaTypeController@destroy')->name('admin.mediaType.destroy');
    });

    Route::prefix('restore')->group(function () {
        Route::get('user/{name}', 'UserController@restore')->name('admin.user.restore');
    });
});

Route::group(['prefix' => 'trip'], function() {
    Route::get('{url}', 'TripController@show')->name('trip.show');
});




