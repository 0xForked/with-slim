<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{

    protected $table = 'users_token';

    protected $fillable = [
        'uuid',
        'unique_token',
        'token_created',
        'token_expired'
    ];

    public $timestamps = false;
}