<?php

/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 9:51
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role.
 *
 * @package App
 */
class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];
}
