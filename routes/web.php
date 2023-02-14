<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('user', 'UserController@post');
    $router->patch('user/{id}', 'UserController@update');
    $router->delete('user/{id}', 'UserController@delete');
    $router->get('user', 'UserController@get');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('client', 'ClientController@post');
    $router->get('client', 'ClientController@get');
    $router->patch('client/{id}', 'ClientController@update');
});