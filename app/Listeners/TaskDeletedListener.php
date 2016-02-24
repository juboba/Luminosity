<?php

/**
 * Listener for TaskDeletedEvent.
 *
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace App\Listeners;

use App\Events\TaskDeletedEvent;

/**
 * Class TaskDeletedListener.
 *
 * @package App\Listeners
 */
class TaskDeletedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TaskDeletedEvent $event
     */
    public function handle(TaskDeletedEvent $event)
    {
        echo 'lalala';
        $event->task->name = 'manu es guay';
        $event->task->save();
    }
}
