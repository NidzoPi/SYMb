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
Route::group(['middleware' => ['web']], function (){

	//Authentication Routes
	/*Route::get('auth/login', 'Auth\LoginController@getLogin');
	Route::post('auth/login', 'Auth\LoginController@postLogin');
	Route::get('auth/logout', 'Auth\LoginController@getLogout');

	//Registration Routes
	Route::get('auth/register', 'Auth\RegisterController@getRegister');
	Route::post('auth/register', 'Auth\RegisterController@create');*/

	Route::get('bikes/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
	Route::get('bikes', ['as' => 'blog.index', 'uses' => 'BlogController@getIndex']);
	Route::get('contact', 'PagesController@getContact');
	Route::post('contact',[
	'uses' => 'PagesController@store',
	'as'   => 'contact.store'
	]);
	Route::get('/', 'PagesController@getIndex');
	Route::resource('posts', 'PostsController');
	Route::resource('specs', 'SpecsController');

});
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');

// For Google SIGN IN SIGN UP
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// For terms and condition
Route::get('/terms-and-conditions', 'PagesController@gettac');

//For search
Route::get('/search', 'BlogController@search')->name('search');

// For Categories
Route::resource('categories', 'CategoryController', ['except' => ['create']]);
// Comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/delete/{id}', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);
// For Tags
Route::resource('tags', 'TagController', ['except' => ['create']]);
//For Review
Route::resource('review', 'PostReviewController');
// For Images

//Route::get('posts/create', 'ImagesController@create');
//Route::post('posts', 'ImagesController@store');
Route::post('posts/image-upload/{post_id}', 'PostsController@uploadImages');
Route::get('posts/{post_id}/delete-image/{id}', 'PostsController@deleteImage');

// For sale
Route::get('forsale', ['as' => 'blog.forsale', 'uses' => 'BlogController@getForsale']);
