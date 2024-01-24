<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role_id',
        'photo_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function photo() : MorphOne
    {
        return $this->morphOne('App\Models\Photo', 'imageable');
    }

    public function post(): HasOne
    {
        return $this->hasOne('App\Models\Post');
    }

    public function posts() : HasMany
    {
        return $this->hasMany('App\Models\Post');
    }

    public function isAdmin()
    {
        if ($this->role){
            if ($this->role()->first()->role_name == 'Administrator' &&
                $this->role()->first()->id == 1 && Auth::user()->is_active == 1){
                return true;
            }
        }

        return false;
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)){
            return $this->attributes['password'] = trim(bcrypt($password));
        }
    }

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (User $user) {
            $user->photo()->delete();
            $user->post()->delete();
        });

    }
}
