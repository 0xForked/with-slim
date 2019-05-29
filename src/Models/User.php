<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'phone',
        'email',
        'password',
        'activation_code',
        'username',
        'forgotten_password_code',
        'forgotten_password_time',
        'status_acc',
        'last_login',
    ];

    protected $guarded = [
        'password'
    ];

    public $timestamps = false;

    public function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

}