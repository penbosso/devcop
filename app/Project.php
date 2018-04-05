<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'company_id',
        'user_id',
        'day'
    ];
    
    public function companys(){
        return $this->belongsTo('App\Company');
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function comments()
    {
        return $this->morphMany('App\comment','commentable');
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
}
