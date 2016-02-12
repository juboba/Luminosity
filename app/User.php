<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'name', 'surname', 'birthdate', 'direction', 'enabled', 'language_id', 'country_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /*
     * Get all of the task for the user
     */
    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function country() {
        return $this->hasOne(Country::class);
    }

    public function language() {
        return $this->hasOne(Language::class);
    }

}
