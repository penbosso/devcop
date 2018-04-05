<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'days',
        'hours',
        'status',
        'project_id',
        'user_id',
        'task_id'
    ];

    public function projects(){
        return $this->belongsTo('App\Project');
    }
    public function company(){
        return $this->belongsTo('App\Company');
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function comments()
    {
        return $this->morphMany('App\comment','commentable');
    }
}
