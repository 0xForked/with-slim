<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Respect\Validation\Validator as V;

class Password extends Controller
{

    /**
     * @author A. A. Sumitro
     * @link https://aasumitro.id
     * @category Userauth - password
     * @param String email
     * @return String email and json message
    */
    public function reset($request, $response)
    {

        $email = $request->getParam('email');

        $validation =  $this->validator->validate($request, [
            'email' => V::noWhiteSpace()->notEmpty()->email()->emailRegistered()
        ]);

        if ($validation->failed()) {
            return $response->withJson(array(
                'errors' => $_SESSION['errors']
            ),400);
        }

        $forgot = User::where('email', $email)->update([
            'forgotten_password_code' => $this->generateKey(64),
            'forgotten_password_time' => time()
        ]);

        if ($forgot) {

            $user = User::where('email', $email)->first();
            $user_detail = UserDetail::where('uuid', $user->unique_id)->first();

            $data = [
                'email' => $user->email,
                'fullname' => $user_detail->full_name,
                'forgotcode' => $user->forgotten_password_code
            ];

            $this->mailer->send(
                'email/pwdreset.twig',
                $data,
                function($message) use ($user)
            {
                $message->to($user->email);
                $message->subject("aassite - Forgot password");
            });

            return $response->withJson(array(
                'code' => 201,
                'error' => false,
                'message' => 'Reset link has been sent to your email address'
            ),201);

        } else {

            return $response->withJson(array(
                'code' => 400,
                'error' => true,
                'dev_msg' => 'Bad Request',
                'user_msg' => 'Failed send a email, email not found'
            ),400);

        }

    }

    /**
     * @author A. A. Sumitro
     * @link https://aasumitro.id
     * @category Userauth - password
     * @param String old password, new password
     * @return String email and json message
    */
    public function changeAfterEmail($request, $response)
    {

        $email = $request->getParam('email');
        $forgot_code = $request->getParam('code');

        if (is_null($forgot_code) && is_null($email)) {

            $message = [
                'code' => 404,
                'dev_msg' => 'Not Found',
                'user_msg' => 'Page Not Found'
            ];

            return $response->withJson($message, 404);

        }

        $user = User::where('forgotten_password_code', $forgot_code)
                    ->where('email', $email)
                    ->select('forgotten_password_time')
                    ->first();

        if ($user) {

            //code expired 30 mins - 60 x 30 = 1800
            $expiration_time = 1800;
            $code_time = $user->forgotten_password_time;
            $expired = time() - $code_time > $expiration_time;
            if ($expired) {

                $message = [
                'code' => 405,
                'dev_msg' => 'Permission not allowed',
                'user_msg' => 'Forgot code already expired'
                ];

                return $response->withJson($message, 405);

            }

            $params = $request->getParsedBody();
            $password = $params['password'];

            if ($password) {
                User::where('forgotten_password_code', $forgot_code)
                    ->update(['password' => password_hash($password,
                                PASSWORD_BCRYPT,
                                ['cost' => 10]),
                                'forgotten_password_code' => null,
                                'forgotten_password_time' => null
                            ]);

                $message = [
                    'code' => 201,
                    'dev_msg' => 'Created',
                    'user_msg' => 'Password Has been changed'
                ];

                return $response->withJson($message, 405);

            }

            $message = [
                'code'     => 405,
                'dev_msg'  => 'Permission not allowed',
                'user_msg' => "Password field must not be null",
            ];

            return $response->withJson($message,405);

        } else {

            $message = [
                'code'     => 405,
                'dev_msg'  => 'Permission not allowed',
                'user_msg' => "Forgot code doesn't match",
            ];

            return $response->withJson($message,405);

        }

    }

    public function changeToken($request, $response)
    {

        $params = $request->getParsedBody();
        $uuid = $params['uuid'];
        $passwordOld = $params['password_old'];
        $passwordNew = $params['password_new'];

        $user = User::where('unique_id', $uuid)->first();

        $validation =  $this->validator->validate($request, [
            'password_old' => V::noWhiteSpace()->notEmpty(),
            'password_new' => V::noWhiteSpace()->notEmpty()->equals($params['password_new_confirm'])
        ]);

        if ($validation->failed()) {
            return $response->withJson(array(
                'errors' => $_SESSION['errors']
            ),400);
        }

        if (!$user) {

            return $response->withJson(array(
                'code' => 400,
                'error' => true,
                'dev_msg' => 'Bad Request',
                'user_msg' => 'user unique id did not match or not passed'
            ),201);

        } else {

            if (password_verify($passwordOld, $user->password)) {

                User::where('unique_id', $uuid)
                    ->update(['password' => password_hash($passwordNew,
                                                            PASSWORD_BCRYPT,
                                                            ['cost' => 10])]);

                return $response->withJson(array(
                    'code' => 201,
                    'error' => false,
                    'message' => 'Change password success'
                ),201);

            } else {

                return $response->withJson(array(
                    'code' => 400,
                    'error' => true,
                    'dev_msg' => 'Bad Request',
                    'user_msg' => 'Old password not match'
                ),400);

            }

        }

    }

}