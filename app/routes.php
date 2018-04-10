<?php

/*
|----------------------------------------------------
| Routing sytem                                      |
|----------------------------------------------------
*/

$app->get('/', function ($request, $response, $args)
{
    return $response
            ->withStatus(200)
            ->write('Hello Buddy, welcome to aassite service!');
});

$app->get('/test', 'AuthLogin:index')->setName('login');