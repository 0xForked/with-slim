<?php

namespace App\Validations\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailRegisteredException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is not found.',
        ],
    ];

}