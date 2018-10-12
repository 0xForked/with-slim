<?php

namespace App\Http\Middlewares;

class ValidationErrorsMiddlerware extends Middleware
{

    public function __invoke($request, $response, $next)
    {

        if (isset($_SESSION['errors'])) {

            $session = $_SESSION['errors'];

            $this->container->view
                    ->getEnvironment()
                    ->addGlobal('errors',  $session);

            unset($_SESSION['errors']);

        }

        $response = $next($request, $response);
        return $response;

    }

}