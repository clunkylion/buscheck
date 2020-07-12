<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //
    protected $fillable = [
        "destinationStation",
        "destinationCity",
    ];
    public function hours(){
        return $this->hasMany('App\Hour');
    }
}
