<?php

namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $table = 'users_details';

    protected $fillable = [
        'uuid',
        'guid',
        'name',
        'avatar'
    ];

}