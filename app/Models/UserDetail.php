<?php

namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $table = 'users_details';

    protected $fillable = [
        'user_uid',
        'group_id',
        'name',
        'avatar'
    ];

}