<?php

namespace App\Http\Controllers\BackOffice;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Respect\Validation\Validator as V;

class Articles extends Controller
{
    public function create($request, $response)
    {
        $uuid = $request->getParams('uuid');
        if (empty($uuid)) {
            $this->checkUUID($uuid, $response);
        } else {

            echo "2";
        }
    }

    public function update($request, $response)
    {
        $uuid = $request->getParams('uuid');
        if (empty($uuid)) {
            $this->checkUUID($uuid, $response);
        } else {

            echo "2";
        }
    }

    public function delete($request, $response)
    {
        $uuid = $request->getParams('uuid');
        $article_id = $request->getParams('articleid');

        $validation =  $this->validator->validate($request, [
            'uuid'         => V::noWhiteSpace()->notEmpty()->uuidAvailable(),
            'articleid'    => V::noWhiteSpace()->notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withJson(array(
                'errors' => $_SESSION['errors']
            ),400);
        } else {
            $delete_article = Article::where('id', $article_id)->delete();
            if ($delete_article) {
                return $response->withJson(array(
                    'code'     => 201,
                    'error'    => false,
                    'dev_msg'  => 'Created',
                    'user_msg' => 'Article mark as headline',
                ));
            } else {
                return $response->withJson(array(
                    'code'     => 404,
                    'error'    => true,
                    'dev_msg'  => 'Not Found',
                    'user_msg' => 'Article Not Found',
                ));
            }
        }
    }

    public function headline($request, $response)
    {
        $uuid = $request->getParams('uuid');
        $article_id = $request->getParams('articleid');

        $validation =  $this->validator->validate($request, [
            'uuid'         => V::noWhiteSpace()->notEmpty()->uuidAvailable(),
            'articleid'    => V::noWhiteSpace()->notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withJson(array(
                'errors' => $_SESSION['errors']
            ),400);
        } else {
            $headline_article = Article::where('id', $article_id)->update(["_headline" => 1]);
            if ($headline_article) {
                return $response->withJson(array(
                    'code'     => 201,
                    'error'    => false,
                    'dev_msg'  => 'Created',
                    'user_msg' => 'Article mark as headline',
                ));
            } else {
                return $response->withJson(array(
                    'code'     => 404,
                    'error'    => true,
                    'dev_msg'  => 'Not Found',
                    'user_msg' => 'Article Not Found',
                ));
            }
        }
    }

    public function publish($request, $response)
    {
        $uuid = $request->getParams('uuid');
        $article_id = $request->getParams('articleid');

        $validation =  $this->validator->validate($request, [
            'uuid'         => V::noWhiteSpace()->notEmpty()->uuidAvailable(),
            'articleid'    => V::noWhiteSpace()->notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withJson(array(
                'errors' => $_SESSION['errors']
            ),400);
        } else {
            $publish_article = Article::where('id', $article_id)->update(["_published" => 1]);
            if ($publish_article) {
                return $response->withJson(array(
                    'code'     => 201,
                    'error'    => false,
                    'dev_msg'  => 'Created',
                    'user_msg' => 'Article published',
                ));
            } else {
                return $response->withJson(array(
                    'code'     => 404,
                    'error'    => true,
                    'dev_msg'  => 'Not Found',
                    'user_msg' => 'Article Not Found',
                ));
            }
        }
    }

}