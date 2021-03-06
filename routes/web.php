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

$router->post('/login', ['middleware' => \App\Http\Middleware\LoginRouteMiddleware::class, 'uses' =>  'LoginController@login']);
$router->post('/register', 'UserController@register');
$router->get('/address', 'AddressController@getAddress');
$router->get('/address-by-status', 'AddressController@getAddressByStatus');
$router->post('/address', 'AddressController@addEditAddress');
$router->delete('/address', 'AddressController@removeAddress');
$router->get('/user', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);