<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'code'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }
    public function projects(){
        return $this->hasMany('App\Project');
    }
    public function comments()
    {
        return $this->morphMany('App\comment','commentable');
    }
    public function roles(){
        return $this->hasMany('App\Role');
    }
    
}