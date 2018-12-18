<?php

use App\Http\Middlewares\AuthMiddleware;
use App\Http\Middlewares\GuestMiddleware;


/*
|----------------------------------------------------
| Routing sytem                                      |
|----------------------------------------------------
*/

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function() {

    $this->get('/login', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/login', 'AuthController:postSignIn');

    $this->get('/register', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/register', 'AuthController:postSignUp');

    $this->get('/password/forgot', 'AuthController:getForgotPassword')->setName('auth.password.forgot');
    $this->post('/password/forgot', 'AuthController:postForgotPassword');

    $this->get('/password/change', 'AuthController:getChagePassword')->setName('auth.password.change');
    $this->post('/password/change', 'AuthController:postChagePassword');

})->add(new GuestMiddleware($container));


$app->group('', function() {

    $this->get('/logout', 'AuthController:getSignOut')->setName('auth.signout');

})->add(new AuthMiddleware($container));