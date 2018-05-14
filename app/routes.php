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

$app->post('/api/register', 'AuthRegis:index')->setName('user_register');
$app->post('/api/login', 'AuthLogin:index')->setName('user_login');
$app->get('/personal-info', 'UserData:index')->add('MiddAuth')->setName('user_data');
$app->get('/password-reset', 'UserPwd:reset')->setName('user_password_reset');
$app->post('/password-change-after-email', 'UserPwd:changeAfterEmail')->setName('user_password_change_after_email');
$app->post('/password-change-with-token', 'UserPwd:changeToken')->add('MiddAuth')->setName('user_password_change_with_token');

// BackOffice
$app->get('/article-created', 'BOArticle:publish')->add('MiddAuth')->setName('article_created');