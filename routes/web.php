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

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('weather', 'HomeController@weather');

Route::get('feedback-views', 'FeedbackController@viewIndex');
Route::get('feedback-views/{id}', 'FeedbackController@viewIndexOne');
Route::get('feedback-send', 'FeedbackController@sendIndex');
Route::post('feedback-send', 'FeedbackController@send')->name('feedback-send');