<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalSale extends Model
{
    //
    protected $fillable = [
        "totalSale",
        "frequentQuantity",
        "normalQuantity",
        "studentQuantity",
        "totalQuantity",
        "userId",
        "driverId",
        "busId",
        "enterpriseId",
        "hourId"
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }
    public function driver()
    {
        return $this->belongsTo('App\Driver', 'driverId');
    }
    public function bus()
    {
        return $this->belongsTo('App\Bus', 'busId');
    }
    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise', 'enterpriseId');
    }
    public function hour()
    {
        return $this->belongsTo('App\Hour', 'hourId');
    }
}
