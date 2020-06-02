<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
