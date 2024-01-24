<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Media extends Model
{
    use HasFactory;

    public function photo() : MorphOne
    {
        return $this->morphOne('App\Models\Photo', 'imageable');
    }
}
