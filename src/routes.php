<?php

/*
|----------------------------------------------------
| Routing sytem                                      |
|----------------------------------------------------
*/

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/login', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/login', 'AuthController:postSignIn');

$app->get('/register', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/register', 'AuthController:postSignUp');

$app->get('/logout', 'AuthController:getSignOut')->setName('auth.signout');