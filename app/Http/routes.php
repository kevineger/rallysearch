<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as'   => 'content.index',
    'uses' => 'ContentSearchController@index'
]);
Route::post('filter', [
    'as'   => 'content.filter',
    'uses' => 'ContentSearchController@filter'
]);
Route::get('cloud', [
    'as'   => 'content.cloudvision',
    'uses' => 'SubredditController@cloudVision'
]);
Route::get('cloud-single', [
    'as'   => 'content.single-cloudvision',
    'uses' => 'ContentSearchController@single'
]);
