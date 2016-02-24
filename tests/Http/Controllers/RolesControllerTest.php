<?php

/**
 * @author Manuel Serrano Rodriguez <mserranos@atsistemas.com>
 */

namespace Tests\Http\Controllers;

use Tests\TestCase;

/**
 * Class RolesControllerTest.
 *
 * This class tests the correct behaviour of the Role API.
 */
class RolesControllerTest extends TestCase
{
    /**
     * Test show method.
     */
    public function testShow()
    {
        $this->get('/roles')
            ->seeJson();
        $this->assertEquals(200, $this->response->status());
    }
}
