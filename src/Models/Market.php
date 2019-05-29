<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{

    protected $fillable = [
        'title',
        'address',
        'lat',
        'lng',
    ];

    public $timestamps = false;

}