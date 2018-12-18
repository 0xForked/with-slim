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

        if (!$user) {
            $this->flash->addMessage('error', 'Failed registered new account!');
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

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

    public function getForgotPassword()
    {
        return $this->view->render($response, 'auth/password-forgot.twig');
    }

    public function postForgotPassword()
    {
        $email = $request->getParam('email');

        $validation = $this->validator->validate($request, [
            'email' => Validator::noWhiteSpace()->notEmpty()->email(),
        ]);

        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('auth.password.forgot'));
        }

        $forgot = User::where('email', $email)->update([
            'forgotten_password_code' => $this->stringHelper->randomString(),
            'forgotten_password_time' => time()
        ]);

        if(!$forgot) {
            $this->flash->addMessage('error', "Failed generate forgotten password code!");
            return $response->withRedirect($this->router->pathFor('auth.password.forgot'));
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->flash->addMessage('error', "Couldn't find user with that address!");
            return $response->withRedirect($this->router->pathFor('auth.password.forgot'));
        }

        $data = [
            'fullname' => 'default admin'
        ];
        $this->sendMail($user, $data);

        $this->flash->addMessage('info', "Please check your email address!");
        return $response->withRedirect($this->router->pathFor('auth.password.forgot'));
    }

    public function getChagePassword($request, $response)
    {
        $uuid = $request->getParam('uuid');
        $forgotten_code = $request->getParam('code');

        return $this->resetPasswordView($uuid, $forgotten_code, null, $response);
    }

    public function postChagePassword($request, $response)
    {
        $params = $request->getParsedBody();
        $uuid = $params['user_uid'];
        $forgotten_code = $params['forgot_code'];
        $passwordNew = $params['newPassword'];
        $passwordNewConfirm = $params['confirmPassword'];

        $validation = $this->validator->validate($request, [
            'newPassword' => Validator::noWhitespace()->notEmpty(),
            'confirmPassword' =>  Validator::equals($passwordNew)
        ]);

        if ($validation->failed()) {
            $this->flash->addMessage('Error', "password and confirm didnt match!");
            return $this->view->render(
                $response,
                'auth/password-change.twig',
                ['data_uuid' => $uuid, 'data_code' => $forgotten_code]
            );
        }

        return $this->resetPasswordView($uuid, $forgotten_code, $passwordNew, $response);
    }

    private function resetPasswordView($uuid, $forgotten_code, $password, $response)
    {
        if (!$forgotten_code || !$uuid) {
            return $this->view->render($response, 'error/404.twig');
        }

        $user = User::where('forgotten_password_code', $forgotten_code)
                    ->where('unique_id', $uuid)
                    ->select('forgotten_password_time')
                    ->first();

        if (!$user){
            return $this->view->render($response, 'error/404.twig');
        }

        if ($password) {

            //code expired 30 mins - 60 x 30 = 1800
            $expiration_time = 11800;
            $code_time = $user->forgotten_password_time;
            $expired = time() - $code_time > $expiration_time;
            if ($expired) {
                return $this->view->render($response, 'error/404.twig');
            }

            User::where('forgotten_password_code', $forgotten_code)
                ->where('unique_id', $uuid)
                ->update([
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'forgotten_password_code' => null,
                'forgotten_password_time' => null
            ]);

            $this->flash->addMessage('Info', "Your password was changed!");
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $this->view->render(
            $response,
            'auth/password-change.twig',
            ['data_uuid' => $uuid, 'data_code' => $forgotten_code]
        );

    }

    private function sendMail($user_main, $user_detail) {
        $this->mailer->send(
            'email/forgot_message.twig',
            [
                'forgotcode' => $user_main->forgotten_password_code,
                'unique_id' => $user_main->unique_id,
                'fullname' => $user_detail->fullname
            ],
            function($message) use ($user_main) {
                $subject = "Reservation Online - Forgot password";
                $message->to($user_main->email);
                $message->subject($subject);
            }
        );
    }


}