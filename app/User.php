<?php
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

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
        'email', 'name', 'surname', 'password', 'username', 'birthday', 'direction',
        'enabled', 'language_id', 'country_id', 'role_id',

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
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function roles()
    {
        return $this->hasOne(Role::class, 'id');
    }
}
