<?php

/*
|----------------------------------------------------
| Routing sytem                                      |
|----------------------------------------------------
*/

$app->get('/', function ($request, $response, $args)
{

    return $response
            ->withStatus(200, 'OK')
            ->write("Hello Buddy, There's nothing here!");

});

$app->post('/register', 'AuthRegis:index')->setName('user_register');
$app->post('/login', 'AuthLogin:index')->setName('user_login');
$app->get('/personal-info', 'UserData:index')->add('MiddAuth')->setName('user_data');


// $app->post('/v1/user/auth/password/change', 'AuthLogin:index')->setName('login');
// $app->post('/v1/user/auth/password/reset', 'AuthLogin:index')->setName('login');