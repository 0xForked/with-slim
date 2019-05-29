<?php

use App\Http\Middlewares\AuthMiddleware;
use App\Http\Middlewares\GuestMiddleware;


/*
|----------------------------------------------------
| Routing sytem                                      |
|----------------------------------------------------
*/

$app->get('/', function($request, $response) {
    return $response->withStatus(303)->withHeader('Location', '/login');
})->setName('redirect');

$app->group('', function() {
    $this->get('/login', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/login', 'AuthController:postSignIn');

    $this->get('/password/forgot', 'AuthController:getForgotPassword')->setName('auth.password.forgot');
    $this->post('/password/forgot', 'AuthController:postForgotPassword');

    $this->get('/password/change', 'AuthController:getChagePassword')->setName('auth.password.change');
    $this->post('/password/change', 'AuthController:postChagePassword');

})->add(new GuestMiddleware($container));


$app->group('', function() {

    $this->get('/dashboard', 'DashboardController:index')->setName('dash.home');

    $this->get('/logout', 'AuthController:getSignOut')->setName('auth.signout');

})->add(new AuthMiddleware($container));