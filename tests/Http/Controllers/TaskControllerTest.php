<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Task;

/**
 * Class TaskControllerTest.
 *
 * This class tests the correct behaviour of the Tasks API.
 */
class TaskControllerTest extends TestCase
{
//    use DatabaseTransactions;

    public static $idUser;
    public static $headers = array();
    public static $userData = array();
    public $taskData = ['name' => 'Test task', 'description' => 'This is a test task.', 'language_id' => 1, 'user_id' => 1];

    public function setUp()
    {
        parent::setUp();
        static::$userData = ['username' => 'test', 'password' => base64_encode('123'), 'language_id' => 1, 'country_id' => 1];
        $user = \App\User::withTrashed()->where('username', '=', 'test')->first();

        if (!$user)
        {
            $user = factory(\App\User::class)->create(static::$userData);
        }
        if ($user->trashed()) {
            $user->restore();
        }

        static::$idUser = $user->id;
        static::$headers =  array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Token::createToken($user),
        );
        $this->taskData['user_id'] = $user->id;
    }

    public function tearDown()
    {
        $user = \App\User::find(static::$idUser);
        $tasks = \App\Task::where('user_id', '=', $user->id);
        $tasks->forceDelete();
        if (null !== $user)
        {
            $user->delete();
        }
        parent::tearDown();
    }

    /**
     * Test index.
     */
    public function testIndex()
    {
        $this->get('/api/v0_01/tasks', static::$headers)
            ->seeJson();
        $this->assertEquals(200, $this->response->status());
    }

    /**
     * Test task.
     */
    public function testTask()
    {
        $task = factory(\App\Task::class)->create($this->taskData);
        $this->get('/api/v0_01/tasks/'.$task->id, static::$headers);
        $this->assertEquals(200, $this->response->status());
        $this->seeJson($this->taskData);
    }

    /**
     * Test not found error when getting an invalid task.
     */
    public function testTaskNotFound()
    {
        $idTask = 0;
        $this->get('/api/v0_01/tasks/'.$idTask, static::$headers);
        $this->assertEquals(404, $this->response->status());
//        $this->assertEquals('[]', $this->response->getContent());
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

        $this->post('/api/v0_01/tasks', $this->taskData, static::$headers);

        $this->assertEquals(200, $this->response->status());
        $this->seeJsonEquals(['success' => true]);
    }

    /**
     * Test 403 error when posting a task with incomplete data.
     */
    public function testStoreKO()
    {
        $this->post('/api/v0_01/tasks', ['name' => 'New task'], static::$headers);

        $this->assertEquals(403, $this->response->status());
        $this->seeJsonEquals(['description' => ['The description field is required.']]);
    }

    /**
     * Test updateTask.
     */
    public function testUpdateTask()
    {
//        $task = factory(\App\Task::class)->create($this->taskData);
//        $result = $this->put('/api/v0_01/tasks/'.$task->id, $this->taskData, static::$headers);
//        $result->seeJson($this->taskData);
//        $this->assertEquals(200, $this->response->status());
//        $this->delete('/api/v0_01/tasks/'.$task->id, array(), static::$headers);
        $this->markTestIncomplete('Method not fully implemented.');
    }

    /**
     * Test destroyTask.
     */
    public function testDestroyTask()
    {
        $task = factory(\App\Task::class)->create($this->taskData);
        $this->delete('/api/v0_01/tasks/'.$task->id, array(), static::$headers);
        $this->assertEquals(200, $this->response->status());

        // Check that the task cannot be found.
        $deletedTask = Task::find($task->id);
        $this->assertNull($deletedTask);
        // Check that task was soft-deleted.
        $deletedTask = Task::withTrashed()->find($task->id);
        $this->assertNotNull($deletedTask);
//        $this->notSeeInDatabase('tasks', ['id' => $task->id]);
    }

    /**
     * Test 404 error when deleting an invalid task.
     */
    public function testDestroyTaskKO()
    {
        $idTask = 0;
        $this->delete('/api/v0_01/tasks/'.$idTask, array(), static::$headers);
        $this->assertEquals(404, $this->response->status());
    }
}
