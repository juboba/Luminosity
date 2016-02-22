<?php

/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 9:51.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language.
 *
 * @package App
 */
class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'profix',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * Get all tasks for the language.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function task()
    {
        $this->hasMany(Task::class);
    }
}
