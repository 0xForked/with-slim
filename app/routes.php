<?php

/*
|----------------------------------------------------
| Routing sytem                                      |
|----------------------------------------------------
*/

$app->get('/', function ($request, $response, $args)
{
    //Test monolog for logger
    // $this->logger->critical('oppppppssss', array('data' => 'test'));
    // $this->logger->info('Something interesting happened', array('username' => 'asu'));
    // $this->logger->warning('Foo', array('gg' => 'wp'));
    // $this->logger->error('Bar');

    return $response
            ->withStatus(200, 'OK')
            ->write('Hello Buddy, welcome to aassite service!');

});

$app->get('/test', 'AuthLogin:index')->setName('login');