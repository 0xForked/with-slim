<?php

namespace App\Base\Validations\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class EmailAvailable extends AbstractRule
{
    public function validate($input)
    {
        return User::where('email', $input)->count() === 0;
    }
}