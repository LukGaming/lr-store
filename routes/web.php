<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductController;



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
    $router->get('user/{id}', 'UserController@getById');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('client', 'ClientController@post');
    $router->get('client', 'ClientController@get');
    $router->patch('client/{id}', 'ClientController@update');
    $router->delete('client/{id}', 'ClientController@delete');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('manufacturer', 'ManufacturerController@get');
    $router->post('manufacturer', 'ManufacturerController@post');
    $router->patch('manufacturer/{id}', 'ManufacturerController@update');
    $router->delete('manufacturer/{id}', 'ManufacturerController@delete');
    $router->get('manufacturer/{id}', 'ManufacturerController@getById');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('product', 'ProductController@post');
    $router->get('product', 'ProductController@get');
    $router->patch('product/{id}', 'ProductController@update');
    $router->delete('product/{id}', 'ProductController@delete');
     $router->get('product/{id}', 'ProductController@getById');
});

