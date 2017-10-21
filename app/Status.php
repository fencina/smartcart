<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const PENDING = 1;
    const CONFIRMED = 2;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get pending status
     *
     * @return mixed|static
     */
    public static function pending()
    {
        return static::find(static::PENDING);
    }

    /**
     * Get confirmed status
     *
     * @return mixed|static
     */
    public static function confirmed()
    {
        return static::find(static::CONFIRMED);
    }
}
