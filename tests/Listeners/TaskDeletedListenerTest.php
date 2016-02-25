<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace Tests\Listeners;

use Tests\TestCase;
use App\Listeners\TaskDeletedListener;
use App\Events\TaskDeletedEvent;
use App\Task;

/**
 * Class TaskDeletedListenerTest.
 *
 * This class tests the correct behaviour of the TaskDeletedListener methods.
 */
class TaskDeletedListenerTest extends TestCase
{
    /**
     * Parameters of a sample task.
     *
     * @var array
     */
    public $taskData = [
        'name' => 'Test task', 'description' => 'This is a test task.', 'language_id' => 1, 'user_id' => 1
    ];

    /**
     * Test handle.
     */
    public function testHandle()
    {
        // Create a new task for testing.
        $task = factory(Task::class)->create($this->taskData);

        // Test the event handling.
        $event = new TaskDeletedEvent($task);
        $listener = new TaskDeletedListener();
        $listener->handle($event);
        $this->assertEquals('manu es guay', $task->name);

        // Delete the task completely.
        $task->forceDelete();
    }
}
