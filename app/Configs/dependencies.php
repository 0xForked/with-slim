<?php

use Illuminate\Database\Capsule\Manager as Eloquent;
use Respect\Validation\Validator as RespectValidation;
use PHPMailer\PHPMailer\PHPMailer;
use App\Validations\Validator;
use App\Mailers\Mailer;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FingersCrossedHandler;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use App\Http\Controllers\Authentication\Login as AuthLogin;
use App\Http\Controllers\Authentication\Register as AuthRegis;
use App\Http\Controllers\Authentication\Personalinfo as UserData;
use App\Http\Controllers\Authentication\Password as UserPwd;
use App\Http\Controllers\BackOffice\Articles as BOArticle;
use App\Http\Middlewares\ValidationErrorsMiddlerware as ValidatorMidd;
use App\Http\Middlewares\Authentication as AuthMidd;

/*
|----------------------------------------------------
| Slim Container                                    |
|----------------------------------------------------
*/

    $container = $app->getContainer();

/*
|----------------------------------------------------
| Eloquent ORM                                      |
|----------------------------------------------------
*/

    $capsule =  new Eloquent();
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

/*
|----------------------------------------------------
| Monolog Logger                                    |
|----------------------------------------------------
*/

    $container['logger'] = function($c) {
        $logger = new Logger('logger');
        $logDir = __DIR__ . ('/../../public/logs/app.log');
        $logHandler = new StreamHandler($logDir, Logger::DEBUG);
        $logCrossedHandler = new FingersCrossedHandler($logHandler, Logger::ERROR);
        $logger->pushHandler($logCrossedHandler);
        return $logger;
    };

/*
|----------------------------------------------------
| Respect Validator                                 |
|----------------------------------------------------
*/

    $container['validator'] = function ($container)
    {
        return new \App\Validations\Validator($container);
    };

    RespectValidation::with('App\\Validations\\Rules\\');

/*
|----------------------------------------------------
| PHP Mailer                                        |
|----------------------------------------------------
*/

    $container['mailer'] = function ($container)
    {
        $mailer = new PHPMailer();

        //$mailer->SMTPDebug = 3;

        $mailer->isSMTP();

        $mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //$mailer->Host = 'tsl://smtp.gmail.com:587';
        $mailer->Host = 'ssl://smtp.gmail.com:465';

        $mailer->SMTPAuth = true;
        $mailer->Username = 'fookipoke@gmail.com';
        $mailer->Password = 'moxdisrlfzrlcbof';

        $mailer->setFrom('hello@aasumitro.id', 'Agus Adhi Sumitro');

        $mailer->isHtml(true);

        return new Mailer($container->view, $mailer);

    };

/*
|----------------------------------------------------
| Controller                                        |
|----------------------------------------------------
*/

    $container['AuthLogin'] = function ($container) { return new AuthLogin($container); };
    $container['AuthRegis'] = function ($container) { return new AuthRegis($container); };
    $container['UserData'] = function ($container) { return new UserData($container); };
    $container['UserPwd'] = function ($container) { return new UserPwd($container); };
    $container['BOArticle'] = function ($container) { return new BOArticle($container); };

/*
|----------------------------------------------------
| Middleware                                        |
|----------------------------------------------------
*/

    $app->add(new ValidatorMidd($container));
    $container['MiddAuth'] = function ($container) { return new AuthMidd($container); };


/*
|----------------------------------------------------
| Twig                                              |
|----------------------------------------------------
*/

    $container['view'] = function ($container)
    {
        $view = new Twig(
            __DIR__ . '/../../resources/views/',
            [ 'cache' => false ]
        );

        $basePath = rtrim(str_ireplace('index.php', '',
            $container['request']->getUri()->getBasePath()), '/'
        );

        $view->addExtension(new TwigExtension($container['router'], $basePath));

        return $view;
    };

    $container['notFoundHandler'] = function ($container)
    {
        return function ($request, $response) use ($container)
        {

            $message = [
                'code' => 404,
                'dev_msg' => 'Not Found',
                'user_msg' => 'Page Not Found'
            ];

            return $response->withJson($message, 404);

        };
    };