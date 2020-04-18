<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
//    protected $dateFormat = 'Y-m-d H:i:s';
  //  use Notifiable, HasRoles, HasApiTokens;
//    protected $dateFormat = 'Y-m-d H:i:s';
    use Notifiable, HasApiTokens;

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


    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_users');
    }

    public function hasAccess(array $permissions) : bool
    {
        foreach ($this->roles as $role){
            if ($role->hasAccess($permissions)){
                return true;
            }
        }

        return false;
    }

    public function isRole(string $user_role)
    {
        foreach ($this->roles as $role){

            if($role->slug == $user_role){
                return true;
            };
        }

        return false;
    }
}
