<?php

/*
|----------------------------------------------------
| Middleware                                        |
|----------------------------------------------------
*/

    $app->add(new \App\Http\Middlewares\ValidationErrorsMiddlerware($container));
    $app->add(new \App\Http\Middlewares\OldInputMiddleware($container));
    $app->add(new \App\Http\Middlewares\CsrfViewMiddleware($container));
    $app->add($container->csrf);
