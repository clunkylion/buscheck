<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $fillable = [
        "status",
        "patent",
        "brand",
        "model",
        "numSeats",
        "technicalReview",
        "driverId",
        "enterpriseId",
        "hourId"
    ];
    public function driver()
    {
        return $this->belongsTo('App\Driver', 'driverId');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function hours()
    {
        return $this->belongsTo('App\Hour', 'hourId');
    }

    public function enterprise()
    {
        return $this->belongsTo('App\Driver', 'enterpriseId');
    }
}
