<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $fillable = [
        'name', 'company', 'email', 'ip', 'image', 'password', 'status'
    ];

    protected $attributes = [
        'status' => self::STATUS_ENABLED
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'ip' => 'array'
    ];

    public static function statuses()
    {
        return [
            self::STATUS_DISABLED => __('Вимкнений'),
            self::STATUS_ENABLED  => __('Активний')
        ];
    }

    public static function htmlStatuses()
    {
        return [
            self::STATUS_DISABLED => '<i class="la la-remove text-danger"></i> ' . __('Вимкнений'),
            self::STATUS_ENABLED  => '<i class="la la-check text-success"></i> ' . __('Активний')
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAdmin()
    {
        return $this->roles()
            ->where('id', Role::ROLE_ADMIN)
            ->exists();
    }
}
