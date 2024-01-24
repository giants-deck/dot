<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'body',
      'category_id',
      'user_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function photo() : MorphMany
    {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function comments() : HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function owner()
    {
        if ($this->user){
            if ($this->user()->first()->id == Auth::user()->id){
                return true;
            }
        }
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function (Post $post){
            $post->photo()->delete();
        });
    }
}
