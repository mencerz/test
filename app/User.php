<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    const ROLE_CLIENT = 'client';
    const ROLE_MANAGER = 'manager';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $data
     * @return User
     */
    public static function makeClient($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user->assignRole(User::ROLE_CLIENT);
        // for test
        $user->markEmailAsVerified();

        return $user;
    }

    public function isRoleManager()
    {
        return $this->hasRole(static::ROLE_MANAGER);
    }

    public function isRoleClient()
    {
        return $this->hasRole(static::ROLE_CLIENT);
    }

    public function clientRequests() {
        return $this->hasMany(ClientRequest::class, 'user_id','id')->role(self::ROLE_CLIENT);
    }
}
