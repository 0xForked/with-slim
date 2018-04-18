<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $table = 'users_details';

    protected $fillable = [
        'uuid',
        'ugid',
        'full_name',
        'avatar'
    ];

}