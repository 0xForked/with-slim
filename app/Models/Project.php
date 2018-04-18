<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'asp_projects';

    protected $fillable = [
        '_author_id',
        '_slug',
        '_category_id',
        '_tag_id',
        '_title',
        '_description',
        '_headline',
        '_published',
        '_link_android',
        '_link_ios',
        '_link_web',
        '_link_demo',
        '_link_github',
        '_link_guide',
        '_logo',
        'created_at',
        'updated_at',
    ];

}