<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    //
    protected $fillable = [
        "estado",
        "number",
        "busId",
        "driverId",
        "enterpriseId"
    ];
    public function bus()
    {
        return $this->belongsTo('App\Bus', 'busId');
    }
    public function driver()
    {
        return $this->belongsTo('App\Bus', 'driverId');
    }
    public function enterprise()
    {
        return $this->belongsTo('App\Bus', 'enterpriseId');
    }
}
