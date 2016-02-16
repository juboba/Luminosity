<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Task;

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
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();

        // Check if the user is a root account
        if($this->have_role->name == 'Root') {
            return true;
        }

        if(is_array($roles)){

            foreach($roles as $need_role){

                if($this->checkIfUserHasRole($need_role)) {

                    return true;

                }
            }
        } else{

            return $this->checkIfUserHasRole($roles);

        }

        return false;
    }

    private function getUserRole()
    {

        return $this->role()->getResults();

    }

    private function checkIfUserHasRole($need_role)
    {

        return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;

    }

    public function tasks()
    {

        return $this->hasMany(Task::class, 'id_user');

    }

    public function role()
    {

        return $this->hasOne(Role::class, 'id', 'role_id');

    }


}
