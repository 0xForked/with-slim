<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'asp_categories';

    protected $fillable = [
        '_slug',
        '_title',
        '_description',
        '_count_used'
    ];
}