<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InterestRatesController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;

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
    $router->get('user', 'UserController@get');
    $router->post('user', 'UserController@post');
    $router->patch('user/{id}', 'UserController@update');
    $router->get('user/{id}', 'UserController@getById');
    $router->delete('user/{id}', 'UserController@delete');
    $router->post('user/authenticate', 'UserController@authenticate');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('credit', 'CreditController@post');
    $router->get('credit', 'CreditController@getAll');
    $router->patch('credit/{id}', 'CreditController@update');
    $router->get('credit/{id}', 'CreditController@getById');
    $router->delete('credit/{id}', 'CreditController@delete');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('client', 'ClientController@post');
    $router->get('client', 'ClientController@get');
    $router->patch('client/{id}', 'ClientController@update');
    $router->get('client/{id}', 'ClientController@getById');
    $router->delete('client/{id}', 'ClientController@delete');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('manufacturer', 'ManufacturerController@get');
    $router->post('manufacturer', 'ManufacturerController@post');
    $router->put('manufacturer/{id}', 'ManufacturerController@update');
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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('payment-method', 'PaymentMethodController@post');
    $router->get('payment-method', 'PaymentMethodController@get');
    $router->patch('payment-method/{id}', 'PaymentMethodController@update');
    $router->delete('payment-method/{id}', 'PaymentMethodController@delete');
    $router->get('payment-method/{id}', 'PaymentMethodController@getById');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('sales', 'SalesController@post');
    $router->get('sales', 'SalesController@get');
    $router->patch('sales/{id}', 'SalesController@update');
    $router->delete('sales/{id}', 'SalesController@delete');
    $router->get('sales/{id}', 'SalesController@getById');
    $router->get('getAllSales', 'SalesController@getAllSales');
});



$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('interest-rate', 'InterestRatesController@post');
    $router->get('interest-rate', 'InterestRatesController@get');
    $router->patch('interest-rate/{id}', 'InterestRatesController@update');
    $router->delete('interest-rate/{id}', 'InterestRatesController@delete');
    $router->get('interest-rate/{id}', 'InterestRatesController@getById');
});
