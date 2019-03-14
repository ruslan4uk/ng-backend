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

Route::get('/', 'IndexController@index')->name('main');
Route::get('/city/{id}', 'IndexController@search');

Route::get('/home', 'HomeController@index')->name('home');

// Frontend guide
Route::get('/guide/{id}', 'Frontend\GuideController@index')->name('frontGuide');
Route::post('/guide/{id}', 'Frontend\GuideController@addComment')->name('addComment');

// Frontend tour
Route::get('/tour/{id}', 'Frontend\TourController@index')->name('frontTour');

// ABOUT
Route::get('/about', function() {
    return view('pages.about');
})->name('about');



// Auth 
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// oAuth2 vk
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('oAuth');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// User profile route
Route::prefix('profile')->middleware('auth', 'role:admin|guide')->group(function () {
    Route::post('upload/avatar', 'Profile\ProfileController@avatar');
    Route::post('upload/license', 'Profile\ProfileController@uploadLicense');
    Route::get('/', 'Profile\ProfileController@index');
    Route::get('show', 'Profile\ProfileController@show');
    Route::put('update', 'Profile\ProfileController@update');

    // Tour Route
    Route::prefix('tour')->middleware('auth', 'role:admin|guide')->group(function () {
        Route::get('/', 'Profile\TourController@index');
        //Rotue::get('/new', 'Profile\TourController@create')->name('tour-create');
        Route::get('edit', 'Profile\TourController@edit')->name('tour-edit');
        Route::get('edit/{id}', 'Profile\TourController@show')->name('tour-show');
        Route::put('update', 'Profile\TourController@update')->name('tour-update');
        // Uploader
        Route::post('upload/cover', 'Profile\TourController@cover');
        Route::post('upload/photo', 'Profile\TourController@uploadPhoto');
    });
});





// Geodata JSON
Route::get('/geo', 'Geodata\CitiesController@index');
Route::get('/geo/countries', 'Geodata\CountriesController@index');

// Search JSON
Route::get('/s', 'Frontend\SearchController@search')->name('mainSearch');