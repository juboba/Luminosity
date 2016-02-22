<?php

/**
 * Example listener.
 */

namespace App\Listeners;

use App\Events\ExampleEvent;

/**
 * Class ExampleListener.
 *
 * @package App\Listeners
 */
class ExampleListener
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
     * @param ExampleEvent $event
     */
    public function handle(ExampleEvent $event)
    {
        //TODO implement this method
    }
}
