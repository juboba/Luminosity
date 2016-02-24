<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace Tests\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\TaskValidate;
use Tests\TestCase;

/**
 * Class TaskControllerTest.
 *
 * This class tests the correct behaviour of the TaskValidate methods.
 */
class TaskValidateTest extends TestCase
{
    public $taskData = [
        'name' => 'Test task', 'description' => 'This is a test task.', 'language_id' => 1, 'user_id' => 1
    ];

    /**
     * Test handle.
     */
    public function testHandle()
    {
        $object = new TaskValidate();
        $request = new Request([], $this->taskData);
        $this->response = $object->handle($request, function () {
            return response()->json([], 200);
        });

        $this->assertEquals(200, $this->response->getStatusCode());
    }

    /**
     * Test 403 error when validation fails.
     */
    public function testHandleKO()
    {
        $object = new TaskValidate();
        $request = new Request([], []);
        $this->response = $object->handle($request, function () {
            return response()->json([], 200);
        });

        $this->assertEquals(403, $this->response->getStatusCode());

        $this->markTestIncomplete('Test different validation errors (min/max values, etc)');
    }
}
