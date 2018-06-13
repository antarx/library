<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    protected $fillable = [
        'role'
    ];

    public static function roles()
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_USER  => 'User',
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
