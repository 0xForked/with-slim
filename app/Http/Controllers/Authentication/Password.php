<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;
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
    public function reset()
    {

        $email = $request->getParam('email');

        $validation =  $this->validator->validate($request, [
            'email' => V::noWhiteSpace()->notEmpty()->email()
        ]);

        if ($validation->failed()) {
            return $response->withJson(array(
                'errors' => $_SESSION['errors']
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
    public function change()
    {

    }

}