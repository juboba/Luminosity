<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace Tests\Jobs;

use App\Jobs\CreateTaskJob;
use App\Task;
use Tests\TestCase;

/**
 * Class CreateTaskJobTest.
 *
 * This class tests the correct behaviour of the CreateTaskJob methods.
 */
class CreateTaskJobTest extends TestCase
{
    /**
     * Test handle.
     */
    public function testHandle()
    {
        $requestParams = [
            'name' => 'Test task', 'description' => 'Task description', 'user_id' => 1, 'language_id' => 1
        ];
        $object = new CreateTaskJob($requestParams);
        $this->response = $object->handle();
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->seeJson($requestParams);

        // Delete the task.
        $taskData = json_decode($this->response->getContent());
        $task = Task::find($taskData->id);
        $task->forceDelete();
    }
}
