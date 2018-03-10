<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Reservation extends model
{
    use Notifiable;

    public $table = "reservations";
    protected $primaryKey = 'resId';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 
        'serviceId', 
        'venueId',
        'lotId', 
        'blockId',
        'resStartDate',
        'resEndDate',
        'resIsUserVerified',
        'resIsAdminAccepted',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
    ];

    public function roles(){
        return $this->belongsToMany('App\Venue');

    }

}

