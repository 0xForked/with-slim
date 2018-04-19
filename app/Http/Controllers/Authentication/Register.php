<?php

namespace App\Http\Controllers\Authentication;
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

            $this->validatedUserData($email, $password);

        }

    }

    private function validatedUserData($email, $password)
    {
        echo 'email '. $email . ' password '. $password;
    }
}