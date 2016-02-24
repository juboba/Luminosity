<?php

/**
 * Event fired when a task is deleted.
 *
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace App\Events;

use App\Events\Event;
use App\Task;

/**
 * Class ExampleEvent.
 *
 * @package App\Events
 */
class TaskDeletedEvent extends Event
{
    /**
     * Task that has been deleted.
     *
     * @var Task
     */
    public $task = null;

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
