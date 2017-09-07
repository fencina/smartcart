<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'facebook_id',
        'google_id',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
