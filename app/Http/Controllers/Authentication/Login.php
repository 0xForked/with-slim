<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    public function index()
    {
        echo Controller::generateKey(64);
    }
}