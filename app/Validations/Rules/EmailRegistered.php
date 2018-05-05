<?php

namespace App\Validations\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class EmailRegistered extends AbstractRule
{
    public function validate($input)
    {
        return User::where('email', $input)->count() !== 0;
    }
}