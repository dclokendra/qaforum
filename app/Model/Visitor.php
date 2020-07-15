<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Visitor extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password','status','verification_key','last_login','email_verified_at','remember_token','reset_token'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected  $nullable = ['last_login'];
}
