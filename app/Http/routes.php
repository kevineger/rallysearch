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
    'uses' => 'AnnotationController@index'
]);
Route::get('ajax/filter', [
    'as'   => 'content.filter',
    'uses' => 'AnnotationController@filter'
]);
Route::get('about', [
    'as'   => 'about',
    'uses' => 'PagesController@about'
]);
/*Route::get('cloud', [
    'as'   => 'content.cloudvision',
    'uses' => 'AnnotationController@cloudVision'
]);
Route::get('cloud-single', [
    'as'   => 'content.single-cloudvision',
    'uses' => 'AnnotationController@single'
]);*/
