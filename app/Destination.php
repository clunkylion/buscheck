<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //
    protected $fillable = [
        "busStation",
        "city",
    ];
    public function hours(){
        return $this->hasMany('App\Hour');
    }
}
