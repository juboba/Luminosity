<?php
/**
 * @author Manuel Serrano Rodriguez <mserranos@atsistemas.com>
 */
use Laravel\Lumen\Testing\DatabaseTransactions;
/**
 * Class TaskControllerTest.
 *
 * This class tests the correct behaviour of the Tasks API.
 */
class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;
    public $taskData = ['name' => 'Test task', 'description' => 'This is a test task.', 'language_id' => 1, 'user_id' => 1];
    /**
     * Test index.
     */
    public function testIndex()
    {
        $this->get('/api/v0_01/tasks')
            ->seeJson();
        $this->assertEquals(200, $this->response->status());
    }
    /**
     * Test task.
     */
    public function testTask()
    {
        $idTask = 0;
        $this->get('/api/v0_01/tasks/'.$idTask);
        $this->assertEquals(200, $this->response->status());
        $this->assertEquals('[]', $this->response->getContent());
    }
    /**
     * Test store.
     */
    public function testStore()
    {
        // This is a workaround to make the expectsJobs binding work properly.
        // https://github.com/laravel/lumen-framework/issues/207#issuecomment-136305487
        unset($this->app->availableBindings['Illuminate\Contracts\Bus\Dispatcher']);
        $this->expectsJobs('App\Jobs\CreateTaskJob');
        $this->post('/api/v0_01/tasks', $this->taskData);
        $this->assertEquals(200, $this->response->status());
        $this->seeJsonEquals(['success' => true]);
    }
    /**
     * Test updateTask.
     */
    public function testUpdateTask()
    {
        $task = factory(\App\Task::class)->create($this->taskData);
        $this->put('/api/v0_01/tasks/'.$task->id, $this->taskData)
            ->seeJson($this->taskData);
        $this->assertEquals(200, $this->response->status());
    }
    /**
     * Test destroyTask.
     */
    public function testDestroyTask()
    {
        $task = factory(\App\Task::class)->create($this->taskData);
        $this->delete('/api/v0_01/tasks/'.$task->id);
        $this->assertEquals(200, $this->response->status());
        $this->notSeeInDatabase('tasks', ['id' => $task->id]);
    }
}