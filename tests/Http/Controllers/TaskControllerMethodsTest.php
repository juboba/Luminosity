<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Controllers\TaskController;

/**
 * Class TaskControllerTest.
 *
 * This class tests the correct behaviour of the TaskController methods.
 */
class TaskControllerMethodsTest extends TestCase
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

        if (!$user) {
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
        $controller = new TaskController();
        $this->response = $controller->index();
        $this->seeJson();
        $this->assertEquals(200, $this->response->status());
    }

    /**
     * Test options.
     */
    public function testOptions()
    {
        $controller = new TaskController();
        $this->response = $controller->options();
        $methods = json_decode($this->response->getContent());
        $this->assertEquals(['options', 'get', 'post'], $methods);
        $this->assertEquals(200, $this->response->status());
    }

    /**
     * Test task.
     */
    public function testTask()
    {
        $request = new Request();
        $task = factory(\App\Task::class)->create($this->taskData);
        $controller = new TaskController();

        // Test normal request.
        $this->response = $controller->task($request, $task->id);
        $this->assertEquals(200, $this->response->status());
        $this->seeJson($this->taskData);

        // Test request with language options
        $request->query->set('language', true);
        $this->response = $controller->task($request, $task->id);
        $this->assertEquals(200, $this->response->status());
        $data = $this->taskData;
        $data['language'] = array('id' => 1, 'name' => 'Spanish', 'prefix' => 'ES');
        $this->seeJson($data);
    }

    /**
     * Test not found exception when getting an invalid task.
     *
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testTaskNotFound()
    {
        $request = new Request();
        $controller = new TaskController();
        $this->response = $controller->task($request, 0);
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

        $request = new Request([], $this->taskData);
        $task = factory(\App\Task::class)->create($this->taskData);
        $controller = new TaskController();
        $this->response = $controller->store($request);

        $this->assertEquals(200, $this->response->status());
        $this->seeJsonEquals(['success' => true]);
    }

    /**
     * Test destroyTask.
     */
    public function testDestroyTask()
    {
        $controller = new TaskController();
        $task = factory(\App\Task::class)->create($this->taskData);

        $this->response = $controller->destroyTask($task->id);
        $this->assertEquals(200, $this->response->status());

        // Check that the task cannot be found.
        $deletedTask = Task::find($task->id);
        $this->assertNull($deletedTask);
        // Check that task was soft-deleted.
        $deletedTask = Task::withTrashed()->find($task->id);
        $this->assertNotNull($deletedTask);
    }
}
