<?php

namespace App\Validations\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class UuidAvailable extends AbstractRule
{
    public function validate($input)
    {
        return User::where('unique_id', $input)->count() !== 0;
    }
}