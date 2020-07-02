<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $fillable = [
        "driverStatus",
        "peopleId",
        "enterpriseId",

    ];
    public function enterprise(){
        return $this->belongsTo('App\Enterprise', 'enterpriseId');
    }
    public function people(){
        return $this->belongsTo('App\People', 'peopleId');
    }
}
