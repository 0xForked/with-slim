<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;

use Respect\Validation\Validator;

class AuthController extends Controller
{

    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/register.twig');
    }

    public function postSignUp($request, $response)
    {

        $validation = $this->validator->validate($request, [
            'email' => Validator::noWhitespace()->notEmpty(),
            'username' => Validator::noWhitespace()->notEmpty(),
            'password' => Validator::noWhitespace()->notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'username' => $request->getParam('username'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT)
        ]);

        $this->flash->addMessage('info', 'Your have been signed up!');

        $this->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignIn($request, $response)
    {
        return $this->view->render($response, 'auth/login.twig');
    }

    public function postSignIn($request, $response)
    {
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('error', "Your data didn't match!");
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignOut($request, $response)
    {
        $this->auth->logout();

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getChagePassword($request, $response)
    {
        // return password view
    }

    public function postChagePassword($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'password_old' => Validator::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password_new' => Validator::noWhitespace()->notEmpty()
        ]);

        if ($validation->failed()) {
            // return password view
        }

        $this->auth->user()->setPassword($request->getParam('password_new'));

        $this->flash->addMessage('Info', "Your password was changed!");

        // return redirect view
    }

    public function getForgotPassword()
    {

    }

    public function postForgotPassword()
    {

    }

}