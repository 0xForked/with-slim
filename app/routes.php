<?php

/*
|----------------------------------------------------
| Routing sytem                                      |
|----------------------------------------------------
*/

$app->get('/', function ($request, $response, $args)
{
    //Test monolog for logger
    // $this->logger->critical('oppppppssss');
    // $this->logger->addInfo('Something interesting happened');
    // $this->logger->warning('Foo');
    // $this->logger->error('Bar');

    return $response
            ->withStatus(200, 'OK')
            ->write('Hello Buddy, welcome to aassite service!');

});

$app->get('/test', 'AuthLogin:index')->setName('login');