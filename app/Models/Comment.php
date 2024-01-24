<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'is_active',
        'author',
        'email',
        'body',
        'photo'
    ];
    public function replies() : HasMany
    {
        return $this->hasMany('App\Models\CommentReply');
    }
}
