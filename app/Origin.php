<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    //
    protected $fillable = [
        "busStation",
        "city"
    ];
    public function hours(){
        return $this->hasMany('App\Hour');
    }
}
