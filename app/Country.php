<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 9:48
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $fillable = [
        'name', 'profix',
    ];
}