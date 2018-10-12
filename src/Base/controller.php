<?php

/*
|----------------------------------------------------
| Controller                                        |
|----------------------------------------------------
*/

$container['HomeController'] = function ($container) {
    return new \App\Http\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {
    return new \App\Http\Controllers\AuthController($container);
};

