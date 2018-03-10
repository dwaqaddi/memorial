<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $table = "users";
    protected $primaryKey = 'userId';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userEmail', 
        'password', 
        'userFName', 
        'userMName',
        'userLName',
        'userMobileNumber',
        'userAddress1',
        'userAddress2',
        'api_token',
        'userIsUserVerified',
        'userIsActive', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
    ];

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }

    // public function getAuthPassword()
    // {
    //     return $this->userPassword;
    // }

}
