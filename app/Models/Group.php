<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;

}