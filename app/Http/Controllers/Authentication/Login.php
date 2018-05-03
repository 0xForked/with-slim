<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserToken;
use Respect\Validation\Validator as V;

class Login extends Controller
{

    /**
     * @author A. A. Sumitro
     * @link https://aasumitro.id
     * @category Userauth - login
     * @param String email, password
     * @return JSONdata
    */
    public function index($request, $response)
    {

        $params = $request->getParsedBody();
        $email = $params['email'];
        $password = $params['password'];

        $validation =  $this->validator->validate($request, [
            'email'         => V::noWhiteSpace()->notEmpty()->email(),
            'password'      => V::noWhiteSpace()->notEmpty()
        ]);

        if ($validation->failed()) {

            return $response->withJson(array(
                    'errors' => $_SESSION['errors']
            ),400);

        } else {

            $user = User::where('email', $email)->first();

            if (!$user){
                return $response->withJson(array(
                    'code' => 400,
                    'error' => true,
                    'dev_msg' => 'Bad Request',
                    'user_msg' => 'Login failed, Email address not found',
                ),400);
            }

            if (password_verify($password, $user->password)) {

                $tokens = UserToken::where('uuid', $user->unique_id)->update([
                    'unique_token'    => $this->generateKey(64),
                    'token_created'   => time(),
                    'token_expired'   => 30
                ]);

                if ($tokens) {

                    $user_token = UserToken::where('uuid', $user->unique_id)->first();

                    return $response->withJson(array(
                        'code'     => 200,
                        'error'    => false,
                        'message'  => 'Login Success',
                        'result'   => [
                            'access_token' => $user_token->unique_token,
                            'unique_id'    => $user->unique_id,
                            'status_acc'   => $user->status_acc
                        ]
                    ),200);

                }
            }

            return $response->withJson(array(
                'code' => 400,
                'error' => true,
                'dev_msg' => 'Bad Request',
                'user_msg' => 'Login failed, Wrong password',
            ),400);

        }

    }

}