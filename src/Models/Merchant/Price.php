<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{

    protected $table = 'merchant_building_prices';

    protected $fillable = [
        'title',
        'description',
        'price',
        'type_id'
    ];

    public $timestamps = false;

}