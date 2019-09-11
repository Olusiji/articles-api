<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('login', [
     'uses' => 'TokenController@requestToken'
]);

// $router->delete('logout', [
//     'uses' => 'TokenController@revokeToken'
// ]);

// $router->post('refresh_token', [
//     'uses' => 'TokenController@refreshToken'
// ]);


//Unprotected
$router->group(['prefix' => 'api/v1'], function() use (&$router){
    $router->get('/articles', [
        'uses' => 'ArticleController@list'
    ]);
    
    $router->get('/articles/{id}', [
        'uses' => 'ArticleController@get'
    ]);
    
    $router->post('/articles/{id}/rating', [
        'uses' => 'ArticleController@rate'
    ]);

    $router->get('/articles/search/title[/{title}]', [
        'uses' => 'ArticleController@search'
    ]);
 });



//Protected
$router->group(['prefix' => 'api/v1', 'middleware' => 'client'], function() use (&$router){
    $router->post('/articles', [
        'uses' => 'ArticleController@create'
    ]);

    $router->put('/articles/{id}', [
        'uses' => 'ArticleController@update'
    ]);

    $router->delete('/articles/{id}', [
        'uses' => 'ArticleController@delete'
    ]);
 });

/*$router->get('/articles/{id}/rating', [
    'uses' => 'ArticleController@rate'
]);*/
