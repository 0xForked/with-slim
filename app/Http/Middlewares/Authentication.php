<?php

namespace App\Http\Middlewares;
use App\Models\UserToken;

class Authentication extends Middleware
{
    public function __construct($token) {
        $this->token = $token;
    }

    public function __invoke($request, $response, $next) {

        $token = $request->getParam('token');

        if ($token) {

            $check_token = UserToken::where('unique_token', $token)->first();

            if ($check_token == null) {

                return $response->withJson(array(
                    'code'     => 405,
                    'error'    => true,
                    'dev_msg'  => 'Permission not allowed',
                    'user_msg' => 'Invalid access token',
                    'relogin'  => true
                ),405);

            }

            $token_expired = time() - $check_token->token_created > $check_token->token_expired;
            if ($token_expired) {

                return $response->withJson(array(
                    'code'     => 405,
                    'error'    => true,
                    'dev_msg'  => 'Permission not allowed',
                    'user_msg' => 'Access Token Expired',
                    'relogin'  => true
                ),405);

            }

        } else {

            return $response->withJson(array(
                'code'     => 401,
                'error'    => true,
                'dev_msg'  => 'Unauthorized',
                'user_msg' => 'Access token require',
                'relogin'  => false
            ),401);

        }

        return $next($request, $response);

    }

}