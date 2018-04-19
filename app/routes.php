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
            ->write('Hello Buddy, Welcome to aassite API service!');

});

$app->post('/v1/user/auth/login', 'AuthLogin:index')->setName('login');
// $app->post('/v1/user/auth/register', 'AuthLogin:index')->setName('login');
// $app->post('/v1/user/auth/password/change', 'AuthLogin:index')->setName('login');
// $app->post('/v1/user/auth/password/reset', 'AuthLogin:index')->setName('login');