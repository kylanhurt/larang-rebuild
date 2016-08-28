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

//beginning of entity-related routes
Route::get('/entity/list', 'EntitiesController@list');
Route::resource('entity', 'EntitiesController');
//end of entity-related routes


//beginning of test routes
Route::get('/howdy', function () {
    return /*view*/('howdy');
});
//end of test routes


//beginning of page routes (obsolete)
Route::get('/about', 'PagesController@about');
//end of page routes


//beginning of user routes
Route::post('/user/register/', 'UsersController@create');
Route::get('users/{username}', function($username) {
    $username_client = new Guzzle\Service\Client('https://api.github.com/');
    $response = $username_client->get("users/$username")->send();
    echo $response->getBody();
});
//end of user routes


//beginning of authentication routes
Route::get('/csrf', function(){ 
    return csrf_token();
});
Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
Route::post('authenticate', 'AuthenticateController@authenticate');
Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
//end of authentication routes


//beginning of reviews routes
Route::resource('review','ReviewsController');
//end of reviews routes
