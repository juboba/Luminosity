<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 9:51.
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 'profix',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function task()
    {
        $this->hasMany(Task::class);
    }
}
