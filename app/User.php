<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'file_number',
        'email',
        'password',
        'role_id',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user has a specified role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $role == $this->role->id;
    }

    /**
     * Check if the user is a SuperAdmin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role->id == Role::SUPER_ADMIN;
    }

    /**
     * Check if the user is a AdminUser
     *
     * @return bool
     */
    public function isAdminUser()
    {
        return $this->role->id == Role::ADMIN_USERS;
    }

    /**
     * Check if the user is a AdminPush
     *
     * @return bool
     */
    public function isAdminPush()
    {
        return $this->role->id == Role::ADMIN_PUSH;
    }

    /**
     * Check if the user is a Cashier
     *
     * @return bool
     */
    public function isCashier()
    {
        return $this->role->id == Role::CASHIER;
    }
}
