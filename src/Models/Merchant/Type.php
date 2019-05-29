<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $table = 'merchant_types';

    protected $fillable = [
        'title',
        'description'
    ];

    public $timestamps = false;

}