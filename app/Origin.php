<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    //
    protected $fillable = [
        "originStation",
        "originCity"
    ];
    public function hours(){
        return $this->hasMany('App\Hour');
    }
}
