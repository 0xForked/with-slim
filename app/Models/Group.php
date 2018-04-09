<?php

namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'description',
    ];

}