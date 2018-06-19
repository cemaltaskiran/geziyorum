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
/*
    TODO;
Trip edit
trip api+
Konum api+
media api+
User sayfası+
explore için arama+
user şikayet
media şikayet
yorum şikayet+
galeri
map
*/

Route::get('/', function () {
    return view('homepage');
})->name('homepage')->middleware('ban');

Auth::routes();

Route::get('/punished', 'HomeController@punished')->name('punished');

Route::get('/explore', 'TripController@explore')->name('explore')->middleware('ban');

Route::group(['middleware' => ['ban']], function() {
    Route::get('/panel', 'HomeController@index')->name('panel');
    Route::get('/{username}', 'UserController@show')->name('user.show');
});

Route::group(['prefix' => 'panel', 'middleware' => ['auth', 'ban']], function() {
    // Main pages
    Route::get('', 'HomeController@index')->name('panel');
    Route::get('edit-account', 'HomeController@showAccount')->name('panel.editAccount');
    Route::post('edit-account', 'HomeController@editAccount')->name('panel.updateAccount');
    Route::get('trips', 'HomeController@trips')->name('panel.trips');
    Route::get('edit-trip/{id}', 'HomeController@showTrip')->name('panel.trip.edit');
    Route::post('update-trip/{id}', 'TripController@update')->name('panel.trip.update');

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    // Main pages
    Route::get('dashboard', 'HomeController@indexAdmin')->name('admin.index');
    Route::get('categories', 'CategoryController@indexAdmin')->name('admin.category.index');
    Route::get('users', 'UserController@indexAdmin')->name('admin.user.index');
    Route::get('media-types', 'MediaTypeController@indexAdmin')->name('admin.mediaType.index');
    Route::get('complaints', 'ComplaintController@index')->name('admin.complaint.index');
    Route::get('reports', 'ReportController@index')->name('admin.report.index');
    Route::post('resolve/{id}', 'ReportController@resolve')->name('admin.report.resolve');
    Route::post('unresolve/{id}', 'ReportController@unresolve')->name('admin.report.unresolve');

    Route::prefix('create')->group(function () {
        Route::get('category', 'CategoryController@create')->name('admin.category.create');
        Route::get('user', 'UserController@create')->name('admin.user.create');
        Route::get('media-type', 'MediaTypeController@create')->name('admin.mediaType.create');
        Route::get('complaint', 'ComplaintController@create')->name('admin.complaint.create');
    });

    Route::prefix('store')->group(function () {
        Route::post('category', 'CategoryController@store')->name('admin.category.store');
        Route::post('user', 'UserController@store')->name('admin.user.store');
        Route::post('media-type', 'MediaTypeController@store')->name('admin.mediaType.store');
        Route::post('complaint', 'ComplaintController@store')->name('admin.complaint.store');
        Route::post('ban', 'BanController@store')->name('admin.ban.store');
    });

    Route::prefix('show')->group(function () {
        Route::get('category/{name}', 'CategoryController@showAdmin')->name('admin.category.show');
        Route::get('user/{username}', 'UserController@showAdmin')->name('admin.user.show');
        Route::get('media-type/{name}', 'MediaTypeController@showAdmin')->name('admin.mediaType.show');
        Route::get('complaint/{id}', 'ComplaintController@showAdmin')->name('admin.complaint.show');
        Route::get('report/{id}', 'ReportController@show')->name('admin.report.show');
        Route::get('ban/{id}', 'BanController@show')->name('admin.ban.show');
    });

    Route::prefix('update')->group(function () {
        Route::post('category/{name}', 'CategoryController@update')->name('admin.category.update');
        Route::post('user/{username}', 'UserController@update')->name('admin.user.update');
        Route::post('media-type/{name}', 'MediaTypeController@update')->name('admin.mediaType.update');
        Route::post('complaint/{id}', 'ComplaintController@update')->name('admin.complaint.update');
        Route::post('ban/{id}', 'BanController@update')->name('admin.ban.update');
    });

    Route::prefix('freeze')->group(function () {
        Route::post('trip/{id}', 'TripController@freeze')->name('admin.trip.freeze');
    });

    Route::prefix('unfreeze')->group(function () {
        Route::post('trip/{id}', 'TripController@unfreeze')->name('admin.trip.unfreeze');
    });

    Route::prefix('hide')->group(function () {
        Route::post('trip/{id}', 'TripController@hide')->name('admin.trip.hide');
        Route::post('comment/{id}', 'CommentController@hide')->name('admin.comment.hide');
    });

    Route::prefix('unhide')->group(function () {
        Route::post('trip/{id}', 'TripController@unhide')->name('admin.trip.unhide');
        Route::post('comment/{id}', 'CommentController@unhide')->name('admin.comment.unhide');
    });

    Route::prefix('delete')->group(function () {
        Route::get('category/{name}', 'CategoryController@destroy')->name('admin.category.destroy');
        Route::get('user/{name}', 'UserController@destroy')->name('admin.user.destroy');
        Route::get('media-type/{name}', 'MediaTypeController@destroy')->name('admin.mediaType.destroy');
        Route::get('complaint/{id}', 'ComplaintController@destroy')->name('admin.complaint.destroy');
        Route::post('ban/{id}', 'BanController@destroy')->name('admin.ban.destroy');
    });

    Route::prefix('restore')->group(function () {
        Route::get('user/{name}', 'UserController@restore')->name('admin.user.restore');
    });
});

Route::group(['prefix' => 'trip', 'middleware' => 'ban'], function() {
    Route::get('{url}', 'TripController@show')->name('trip.show');
    Route::post('complaint/{id}', 'TripController@complaint')->name('trip.complaint');
    Route::post('like', 'TripController@like')->name('trip.like');
    Route::post('unlike', 'TripController@unlike')->name('trip.unlike');
    Route::post('comment', 'TripController@comment')->name('trip.comment');
});

Route::post('report', 'ReportController@store')->name('report.store')->middleware('auth');

Route::post('search', 'TripController@search')->name('search');
