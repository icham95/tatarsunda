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

Route::get('/', 'PublicController@index')->name('public');
Auth::routes();

Route::get('locale', function () {
    return \App::getLocale();
});

Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/menu/index', 'MenuController@index')->name('index-menu');
    Route::get('/menu/create', 'MenuController@create')->name('create-menu');
    Route::post('/menu/store', 'MenuController@store');
    Route::get('/menu/edit/{id}', 'MenuController@edit')->name('edit-menu');
    Route::post('/menu/update/{id}', 'MenuController@update')->name('update-menu');
    Route::get('/menu/destroy/{id}', 'MenuController@destroy')->name('delete-menu');

    Route::get('/category/index', 'CategoryController@index')->name('index-category');
    Route::get('/category/create', 'CategoryController@create')->name('create-category');
    Route::post('/category/store', 'CategoryController@store');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('edit-category');
    Route::post('/category/update/{id}', 'CategoryController@update')->name('update-category');
    Route::get('/category/destroy/{id}', 'CategoryController@destroy')->name('delete-category');

    Route::get('/article/index', 'ArticleController@index')->name('index-article');
    Route::get('/article/show/{id}', 'ArticleController@show')->name('show-article');
    Route::get('/article/create', 'ArticleController@create')->name('create-article');
    Route::post('/article/store', 'ArticleController@store')->name('store-article');
    Route::post('/article/upload-image', 'ArticleController@storeImage')->name('store-image-article');
    Route::get('/article/publish/{id}', 'ArticleController@publish')->name('publish-article');
    Route::get('/article/reject/{id}', 'ArticleController@reject')->name('reject-article');
    Route::get('/article/confirm/{id}', 'ArticleController@confirm')->name('confirm-article');
    Route::get('/article/edit/{id}', 'ArticleController@edit')->name('edit-article');
    Route::post('/article/update/{id}', 'ArticleController@update')->name('update-article');
    Route::get('/article/destroy/{id}', 'ArticleController@destroy')->name('delete-article');

    Route::get('/user/index', 'UserController@index')->name('index-user');
    Route::get('/user/{id}/confirmation-yes', 'UserController@confirmation_yes')->name('confirmation-yes-user');
    Route::get('/user/{id}/confirmation-no', 'UserController@confirmation_no')->name('confirmation-no-user');
    Route::get('/user/{id}/edit', 'UserController@edit')->name('edit-user');
    Route::post('/user/{id}/update', 'UserController@update')->name('update-user');
    Route::get('/user/{id}/pdf', 'UserController@pdf')->name('pdf-user');
    Route::post('/user/onesignal_id', 'UserController@onesignal_id');


});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/{id}', 'UserController@show')->name('profile-user');
Route::get('/category/{name}', 'PublicController@page')->name('page-category');
Route::get('/article/{id}', 'PublicController@article')->name('article');
// Route::post('/test', 'PublicController@upload')->name('upload');

Route::get('test', function () {
    event(new App\Events\UserCreatedArticle('Someone', 'asd'));
    event(new App\Events\AdminConfirmationArticle('Someone', 'asd', 4, 1));
    return "Event has been sent!";
});

Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->subject('Mailgun and Laravel are awesome!');
		$message->to('icham95@gmail.com');
	});
});
