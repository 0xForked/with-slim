<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserToken;
use App\Models\Group;
use Respect\Validation\Validator as V;

class Register extends Controller
{

    /**
     * @author A. A. Sumitro
     * @link https://aasumitro.id
     * @category Userauth - login
     * @param String email, password etc.
     * @return String Json Data
    */
    public function index($request, $response)
    {

        $params = $request->getParsedBody();
        $username = $params['username'];
        $phone = $params['phone'];
        $email = $params['email'];
        $password = $params['password'];
        $fullname = $params['fullname'];

        $unique_id = $this->generateKey(32);
        $unique_token = $this->generateKey(64);

        $token_created = time();
        $token_expired = 10;

        $user_group = 2;
        $status_account = 1;

        $validation =  $this->validator->validate($request, [
            'username'      => V::noWhiteSpace()->notEmpty()->usernameAvailable(),
            'phone'         => V::noWhiteSpace()->notEmpty()->phone(),
            'email'         => V::noWhiteSpace()->notEmpty()->email()->emailAvailable(),
            'password'      => V::noWhiteSpace()->notEmpty(),
            'fullname'      => V::notEmpty()->alpha()
        ]);

        if ($validation->failed()) {

            return $response->withJson(array(
                    'errors' => $_SESSION['errors']
            ),400);

        } else {

            $register = User::create([
                'unique_id'     => $unique_id,
                'username'      => $username,
                'phone'         => $phone,
                'email'         => $email,
                'password'      => password_hash($password,
                                   PASSWORD_BCRYPT, ['cost' => 10]),
                'status_acc'    => $status_account
            ]);

            if ($register) {
                $user = User::where('email', $email)->first();

                UserDetail::create([
                    'uuid'          => $user->unique_id,
                    'ugid'          => $user_group,
                    'full_name'     => $fullname,
                ]);

                UserToken::create([
                    'uuid'            => $user->unique_id,
                    'unique_token'    => $unique_token,
                    'token_created'   => $token_created,
                    'token_expired'   => $token_expired
                ]);

                $user_detail = UserDetail::where('uuid', $user->unique_id)->first();
                $user_token = UserToken::where('uuid', $user->unique_id)->first();
                $groups = Group::where('id', $user_detail->ugid)->first();

                $this->mailer->send(
                    'email/welcome.twig',
                    ['fullname' => $user_detail->full_name],
                    function($message) use ($user)
                {
                    $message->to($user->email);
                    $message->subject("aassite - Welcome Message");
                });

                return $response->withJson(array(
                    'code'     => 201,
                    'error'    => false,
                    'message'  => 'success created new user',
                    'result'   => [
                        'user_id'       => $user->unique_id,
                        'access_token'  => $user_token->unique_token,
                        'status_acc'    => $user->status_acc,
                        'user_group'    => $groups->name
                    ]
                ),201);

            } else {

                return $response->withJson(array(
                    'code'     => 401,
                    'error'    => true,
                    'message'  => 'Auth Error'
                ),401);

            }

        }

    }

}