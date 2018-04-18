<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';

    protected $fillable = [
        'unique_id',
        'unique_token',
        'username',
        'phone',
        'email',
        'password',
        'activation_code',
        'forgotten_password_time',
        'status_acc',
        'last_login'
    ];

    protected $guarded  = [
        'password'
    ];

    public $timestamps = false;

}