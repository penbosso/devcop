<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'name'
    ];

    // public function users(){
    //     return $this->hasMany('App\\User');
    // }
    public function companys(){
        return $this->belongsTo('App\Company');
    }
    public function users(){
        return $this->belongsTo('App\User');
    }
}

