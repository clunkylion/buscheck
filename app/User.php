<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "username",
        "password",
        "role",
        "lastSession",
        "userStatus",
        "enterpriseId",
        "peopleId",
        "busId"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function enterprise()
    {
        //belongsTo relationship, the user have a enterprise
        return $this->belongsTo('App\Enterprise', 'enterpriseId');
    }
    public function people()
    {
        return $this->belongsTo('App\People', 'peopleId');
    }
    public function bus()
    {
        return $this->belongsTo('App\Bus', 'busId');
    }

}
