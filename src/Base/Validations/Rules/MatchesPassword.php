<?php

namespace App\Base\Validations\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class MatchesPassword extends AbstractRule
{

    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function validate($input)
    {
        return password_verify($input, $this->password);
    }
}