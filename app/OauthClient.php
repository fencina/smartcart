<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    /**
     * Get password client object
     *
     * @return mixed
     */
    public static function getPasswordClientSecret()
    {
        return static::where('password_client', 1)->first();
    }
}
