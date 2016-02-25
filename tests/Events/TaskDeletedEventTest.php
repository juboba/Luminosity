<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace Tests\Events;

use Tests\TestCase;
use App\Events\TaskDeletedEvent;
use App\Task;

/**
 * Class TaskDeletedEventTest.
 *
 * This class tests the correct behaviour of the TaskDeletedEvent methods.
 */
class TaskDeletedEventTest extends TestCase
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
     * Test the constructor.
     */
    public function testConstructor()
    {
        // Create a new task for testing.
        $task = factory(Task::class)->create($this->taskData);

        // Test the event constructor.
        $event = new TaskDeletedEvent($task);
        $reflectedTask = new \ReflectionProperty(TaskDeletedEvent::class, 'task');
        $reflectedTask->setAccessible(true);
        $this->assertEquals($task, $reflectedTask->getValue($event));

        // Delete the task completely.
        $task->forceDelete();
    }
}
