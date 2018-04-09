<?php

namespace App\Models\User;
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
        'active'
    ];

    public $timestamps = false;

}