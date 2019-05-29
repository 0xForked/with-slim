<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{

    protected $table = 'merchant_owners';

    protected $fillable = [
        'name',
        'identity_type',
        'identity_number'
    ];

    public $timestamps = false;

}