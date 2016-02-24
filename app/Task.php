<?php

/**
 * Created by PhpStorm.
 * User: yhensel
 * Date: 11/02/16
 * Time: 9:52.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Event;
use App\Events\TaskDeletedEvent;

/**
 * Class Task.
 *
 * @package App
 */
class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'language_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Return the user that belongs to the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the language of the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Override the delete method adding an event.
     *
     * @throws \Exception
     */
    public function delete()
    {
        $result = parent::delete();
        Event::fire(new TaskDeletedEvent($this));

        return $result;
    }
}
