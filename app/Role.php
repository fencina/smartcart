<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SUPER_ADMIN = 1;
    const ADMIN_USERS = 2;
    const ADMIN_PUSH = 3;
    const CASHIER = 4;

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
