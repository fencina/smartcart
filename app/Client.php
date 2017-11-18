<?php

namespace App;

use App\Events\ClientCreated;
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
        'device_token',
        'facebook_id',
        'google_id',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $events = [
        'created' => ClientCreated::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withPivot('owner');
    }

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

    /**
     * Get client's personal group
     *
     * @return Group
     */
    public function getPersonalGroup()
    {
        return $this->groups()->where('personal', 1)->first();
    }
}
