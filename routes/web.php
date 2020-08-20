<?php

use Illuminate\Support\Facades\Route;
  
/**------------------------------------------------------------------------------------------- */ 
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
/** ------------------------------------------------------------------------------------------- */

// Homepage: 
Route::get('/', 'CityController@index')->name('city.index'); 

// Categories of selected City:
Route::get('/cities/{city_id}/categories', 'CityController@show')->name('city.show'); 

// Overview Activities: 
Route::get('/cities/{city_id}/{category_id}/activities', 'ActivityController@show')->name('activity.show'); 

// Specific Activity: 
Route::get('/cities/{city_id}/{category_id}/{activity_id}', 'ActivityController@detail')->name('activity.detail'); 

// Create and store a new Activity as logged-in User: 
Route::get('/activities/create', 'ActivityController@create')->name('activity.create'); 
Route::post('/activities', 'ActivityController@store')->name('activity.store'); 
Route::post('/store', 'ActivityController@registerActivity')->name('activity.registerActivity'); 
 
// Personal Profile Page: 
Route::post('/profile/removeActivity/','ActivityController@removeActivity')->name('activity.removeActivity');
Route::post('/profile/removeregistration/','ActivityController@removeRegistration')->name('activity.removeRegistration');

Route::get('/profile/activities/{activity_id}/edit','ActivityController@edit')->name('activity.edit');
Route::post('/profile/activities/{activity_id}','ActivityController@update')->name('activity.update');

Route::get('/profile/{user_id}', 'ProfileController@show')->name('profile.show');
Route::post('/profile/{user_id}/update', 'ProfileController@updatePicture')->name('profile.picture');
Route::get( '/profile/{user_id}/edit', 'ProfileController@edit')   ->name('profile.edit');
Route::post( '/profile/{user_id}',      'ProfileController@update') ->name('profile.update');

//Search-Bar: 
Route::post('/search', 'ActivityController@search')->name('activity.search'); 

//Review
Route::post('/cities/{city_id}/{category_id}/{activity_id}/review', 'ActivityController@review')->name('activity.review');
Route::get('/cities/{city_id}/{category_id}/{activity_id}/review/{review_id}', 'ReviewController@show');
