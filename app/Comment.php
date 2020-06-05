<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function likes()
    {
    	return $this->morphMany('App\Like', 'likeable');
    }

    public function dislikes()
    {
    	return $this->morphMany('App\Dislike', 'dislikeable');
    }

    public function scopeWithRelations(Builder $query) {
        return $query->with([
            'user', 
            'user.campus', 
            'user.avatar', 
            'post', 
            'post.likes', 
            'post.dislikes', 
            'likes', 
            'dislikes'
        ]);
    }
}
