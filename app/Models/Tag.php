<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'asp_tags';

    protected $fillable = [
        '_slug',
        '_title',
        '_description',
        '_count_used'
    ];

    public $timestamps = false;

}