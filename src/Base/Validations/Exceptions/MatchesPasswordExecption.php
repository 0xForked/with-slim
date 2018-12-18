<?php

namespace App\Base\Validations\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MatchesPasswordExecption extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Password does not match.',
        ],
    ];

}