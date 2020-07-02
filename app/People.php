<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //
    protected $fillable = [
        "rut",
        "name",
        "lastName",
        "phone",
        "email",
        "sex",
        "dateBirth"
    ];
    
}
