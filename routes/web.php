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

Route::get('/', 'MainController@home');
Route::get('/home', 'MainController@home');
Route::get('/logout', 'MainController@logout');
Route::get('/account', 'MainController@account');
Route::post('/accountRequest','MainController@acceptAccount');
Route::get('/schedule', 'MainController@get_room_schedule');
Route::post('/schedule/postSchedule', 'MainController@update_room_schedule');
Route::get('/login', 'MainController@home');
Route::post('/switch','MainController@switch');
Route::post('/loginRequest','MainController@loginRequest');
Route::post('/requestAccount','MainController@requestAccount');
