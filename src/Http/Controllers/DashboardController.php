<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index($request, $response)
    {
        return $this->view->render($response, 'index.twig');
    }

}