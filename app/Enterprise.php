<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    //
    protected $fillable = [
        "enterpriseName",
        "enterpriseAddress",
        "enterpriseCity",
        "enterprisePhone",
        "enterpriseMail"
    ];
    public function users(){
        return $this->hasMany('App\User');
    }
    public function drivers(){
        return $this->hasMany('App\Driver');
    }
}
