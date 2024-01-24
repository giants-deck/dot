<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'is_active',
        'author',
        'email',
        'body',
        'photo'
    ];

    public function comment() : BelongsTo
    {
        return $this->belongsTo('App\Models\Comment');
    }
}
