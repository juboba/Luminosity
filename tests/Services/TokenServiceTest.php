<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace Tests\Services;

use Illuminate\Http\Request;
use App\Service\TokenService;
use App\Task;
use Tests\TestCase;

/**
 * Class TokenServiceTest.
 *
 * This class tests the correct behaviour of the TokenSerivice methods.
 */
class TokenServiceTest extends TestCase
{
    /**
     * Test getTokenFromRequest.
     */
    public function testGetTokenFromRequest()
    {
        $object = new TokenService();
        $token = base64_encode('test:123');
        $authString = 'Bearer '.$token;
        $request = new Request([], [], [], [], [], ['HTTP_AUTHORIZATION' => $authString]);
        $result = $object->getTokenFromRequest($request);

        $this->assertEquals($token, $result);
    }

    /**
     * Test invalid authorization strings in getTokenFromRequest.
     */
    public function testGetTokenFromRequestKO()
    {
        $object = new TokenService();
        $token = base64_encode('test:123');

        // Wrong authorization type.
        $authString = 'Be '.$token;
        $request = new Request([], [], [], [], [], ['HTTP_AUTHORIZATION' => $authString]);
        $result = $object->getTokenFromRequest($request);
        $this->assertNull($result);

        // No authorization.
        $request = new Request([], [], [], [], [], []);
        $result = $object->getTokenFromRequest($request);
        $this->assertNull($result);
    }
}
