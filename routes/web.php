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
    return view('main');
})->name('main');


Route::get('/home', 'HomeController@index')->name('home');


// Auth 
Auth::routes();
// oAuth2 vk
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('oAuth');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');



// Guide
Route::get('guide/{id}', 'GuideController@showProfile')->name('guide');



// User cabinet for guide user
Route::prefix('profile')->group(function () {
    Route::middleware('auth', 'role:admin|guide')->group(function () {
        // Profile page
        Route::get('/', 'Profile\ProfileController@index')->name('guide.profile');

        Route::get('user/profile', function () {
            // Uses first & second Middleware
        });
    }); 
});











// Admin page controller
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth', 'role:admin')->group(function () {
    
    Route::get('/', 'ArticleController@index');


    // All services route
    Route::resource('services', 'ServicesController', ['only' => 'index']);

    // Guide route
    Route::post('guide/{id}', 'GuideController@changeStatus')->name('guide.status');
    Route::resource('guide', 'GuideController');

    // Article route
    // Route::resource('article', 'ArticleController');
    // Route::post('article/upload', 'ArticleController@upload')->name('article.upload');

});


// Admin session api routes
Route::namespace('Admin\Api\v1')->prefix('admin/api/v1')->name('admin.api.')->middleware('auth', 'role:admin')->group(function () {

    Route::resource('services', 'ServicesController');
    Route::resource('guide', 'GuideController');

    Route::post('article/upload', 'ArticleController@upload');
    Route::resource('article', 'ArticleController');
    
});