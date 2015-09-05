<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function profile(){
        return $this->hasOne('App\Models\Profile');
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }

    public function permissions() {
        return $this->hasMany('App\Models\Profile');
    }


    public function hasRole($key) {
        foreach ($this->roles as $role) {
            if ($role->name === $key) {
                return true;
            }
        }

        return false;
    }
}
