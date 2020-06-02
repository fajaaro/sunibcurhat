<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function campus()
    {
        return $this->belongsTo('App\Campus');
    }

    public function avatar()
    {
        return $this->hasOne('App\Avatar');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function dislikes()
    {
        return $this->hasMany('App\Dislike');
    }
}
