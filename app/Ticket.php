<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
        "price",
        "serialNumber",
        "userId",
        "enterpriseId"
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }
    public function enterprise()
    {
        return $this->belongsTo('App\User', 'enterpriseId');
    }
}
