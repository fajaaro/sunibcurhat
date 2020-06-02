<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;

    protected $guarded = [
    	'id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function likeable()
    {
    	return $this->morphTo();
    }
}
