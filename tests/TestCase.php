<?php

/**
 * Base test case class.
 */

namespace Tests;

use Laravel\Lumen\Testing\TestCase as LaravelTestCase;

/**
 * Class TestCase.
 *
 * @package Tests
 */
class TestCase extends LaravelTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
