<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'asp_messages';

    protected $fillable = [
        '_sender_name',
        '_sender_email',
        '_message_title',
        '_message_body',
        '_message_status',
        'created_at',
        'updated_at'
    ];

}