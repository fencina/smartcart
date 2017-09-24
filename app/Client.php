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

    /**
     * Encrypt user's password
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Check if a client is already registered
     *
     * @param $email
     * @return bool
     */
    public static function isRegistered($email)
    {
        return static::where('email', $email)->exists();
    }
}
