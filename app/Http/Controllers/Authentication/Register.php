<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as V;

class Register extends Controller
{

    /**
     * @author A. A. Sumitro
     * @link https://asmith.my.id
     * @category Userauth - login
     * @param String email, password
     * @return JSONdata
    */
    public function index($request, $response)
    {

        $params = $request->getParsedBody();
        $username = $params['username'];
        $phone = $params['phone'];
        $email = $params['email'];
        $password = $params['password'];
        $full_name = $params['fullname'];

        $unique_id = $this->generateKey(32);
        $unique_token = $this->generateKey(64);

        $token_created = time();
        $token_expired = 30;

        $user_group = 2;

        $validation =  $this->validator->validate($request, [
            'username'      => V::noWhiteSpace()->notEmpty()->username(),
            'phone'         => V::noWhiteSpace()->notEmpty()->phone(),
            'email'         => V::noWhiteSpace()->notEmpty()->email(),
            'password'      => V::noWhiteSpace()->notEmpty(),
            'fullname'      => V::noWhiteSpace()->notEmpty()
        ]);

        if ($validation->failed()) {

            return $response->withJson(array(
                    'errors' => $_SESSION['errors']
            ),400);

        } else {

            $register_data = [
                'username'      => $username,
                'phone'         => $phone,
                'email'         => $email,
                'password'      => $password,
                'full_name'     => $full_name,
                'unique_id'     => $unique_id,
                'unique_token'  => $unique_token,
                'token_created' => $token_created,
                'token_expired' => $token_expired,
                'user_group'    => $user_group
            ];

            $this->validatedUserData($register_data);

        }

    }

    private function validatedUserData($register_data)
    {
        echo $register_data;
    }

}