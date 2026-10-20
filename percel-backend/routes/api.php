<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('test',function (){
    return true;
});



Route::group(['namespace' => '\App\Http\Controllers\API'], function () {
    Route::get('/siteinfo', 'HomeController@customerService');
    Route::get('/home-page-content', 'HomeController@homepagecontent');
    Route::post('/contact-us-save','HomeController@contactUs');
    Route::get('countries', 'CommonApiController@getCountries');
    Route::get('/states', 'HomeController@states');
    Route::get('/services', 'ServiceController@Services');
    Route::post('/banner', 'ServiceController@Banner');
    Route::get('/branches','NetworkController@Branches');
     Route::get('/get-branches','NetworkController@getBranches');
    Route::get('/cms/{slug}','HomeController@cms');
    Route::get('/about-us','HomeController@aboutus');
    Route::get('/trackingoutput','TrackingController@tracking');
    Route::get('/joblists','JoblistsController@joblists');
    Route::post('/jobposts','JoblistsController@jobpost');
    Route::get('/clientlist','ClientlistsController@clientlist');
});