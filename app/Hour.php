<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    //
    protected $fillable = [
        "date",
        "hour",
        "originId",
        "destinationId"
    ];
    public function origin()
    {
        return $this->belongsTo('App\Origin', 'originId');
    }
    public function destination()
    {
        return $this->belongsTo('App\Destination', 'destinationId');
    }
    public function buses()
    {
        return $this->hasMany('App\Bus');
    }
}
