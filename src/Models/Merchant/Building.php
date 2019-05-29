<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    protected $table = 'merchant_buildings';

    protected $fillable = [
        'name',
        'description',
        'widht',
        'length',
        'price_id',
        'market_id',
    ];

    public $timestamps = false;

}