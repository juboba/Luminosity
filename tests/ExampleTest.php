<?php

/**
 * Example test class.
 */

namespace Tests;

use Tests\TestCase;

/**
 * Class ExampleTest
 */
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals($this->response->getContent(), $this->app->version());
    }
}
