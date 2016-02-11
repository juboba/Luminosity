<?php
/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 9:52
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $fillable = [
        'title', 'description',
    ];

    /*
     * return the user that belogs the task
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
    /*
     * Get language of the note
     */
    public function languages() {

    }
}