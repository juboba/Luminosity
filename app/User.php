<?php

namespace App;

use Illuminate\Auth\Authenticatable;
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
        'enabled', 'language_id', 'country_id',
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

    /**
     * Get a token for an user.
     *
     * @return bool|string Return token. False on error.
     */
    public function getToken()
    {
        $passphrase = base64_encode($this->username.':'.$this->userpass);

        //Here we must make a curl for get authorization with DOTW server.
        //https://www.traveltech.ro/alpha/api/v1/authorize.json
        //curl -X POST --header "Content-Type: application/json" --header "Accept: application/json" --header "Authorization: Bearer nYulHlSOKc696Cx1Cp40ADa2H8XdVamJhf6JYLo" -d "{
        //\"request\": {
        //\"type\": 2
        //}
        //}"
        //$expiresAt = Carbon::createFromTimestamp('Field expires of dowt response');

        $token = hash('sha256', $passphrase);
        $expiresAt = Carbon::now()->addMinutes(50);

        Cache::put($token, $this->username, $expiresAt);

        return (Cache::has($token)) ? $token : false;
    }
}
