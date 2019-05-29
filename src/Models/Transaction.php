<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [
        'date',
        'created_at',
        'building_id',
        'payable',
        'mulct',
        'total',
        'payment_type',
        'payment_status',
        'payment_time',
        'collector_id',
    ];

    public $timestamps = false;

}