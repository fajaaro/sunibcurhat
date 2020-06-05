<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [
    	'id',
    	'created_at',
    	'updated_at',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
    	return $this->morphMany('App\Like', 'likeable');
    }

    public function dislikes()
    {
    	return $this->morphMany('App\Dislike', 'dislikeable');
    }    

    public function scopeWithRelations(Builder $query)
    {
        return $query->with([
            'user',
            'user.campus', 
            'user.avatar', 
            'comments', 
            'comments.likes', 
            'comments.dislikes', 
            'likes', 
            'dislikes'
        ]);
    }
}
