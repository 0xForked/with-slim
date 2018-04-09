<?php

/*
|----------------------------------------------------
| Routing sytem                                     |
|----------------------------------------------------
*/

$app->get('/', function ($request, $response, $args) {
    return $response->withStatus(200)->write('Hello World!');
});