<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'asp_articles';

    protected $fillable = [
        '_author_id',
        '_category_id',
        '_tag_id',
        '_slug',
        '_title',
        '_content',
        '_image',
        '_published',
        '_headline',
        '_like_count',
        'created_at',
        'updated_at'
    ];

}