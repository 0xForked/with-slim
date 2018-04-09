<?php

namespace App\Http\Controllers;

class Controller
{

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container{$property}) {
            return $this->container->{$property};
        }
    }

    //Generate random md5 keys
    public function generateKey($MaxSize = 32)
    {
        //return unique md5 random key
        //return md5(uniqid(rand(), true));

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $MaxSize; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;

    }

}