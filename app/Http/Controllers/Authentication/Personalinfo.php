<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\UserDetail;
use App\Models\UserToken;

class Personalinfo extends Controller
{
    public function index($request, $response)
    {

        $uuid = $request->getParam('uuid');
        $user = User::where('unique_id', $uuid)->first();

        if (isset($user)) {

            $user_detail = UserDetail::where('uuid', $user->unique_id)->first();
            $user_token = UserToken::where('uuid', $user->unique_id)->first();
            $groups = Group::where('id', $user_detail->ugid)->first();

            $user_data = array(
                'code'     => 200,
                'error'    => "false",
                'message'  => 'Success',
                'result'   => [
                    'access_token'  => $user_token->unique_token,
                    'user_id'       => $user->unique_id,
                    'username'      => $user->username,
                    'phone'         => $user->phone,
                    'email'         => $user->email,
                    'fullname'      => $user_detail->full_name,
                    'group'         => $groups->name,
                ]
            );

            return $response->withJson($user_data, 200);

        } else {

            return $response->withJson(array(
                'status' => 400,
                'error' => true,
                'dev_msg' => 'Bad Request',
                'user_msg' => 'Invalid user unique id'
            ),400);

        }

    }

}