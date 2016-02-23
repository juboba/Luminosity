<?php

/**
 * AuthController test class.
 *
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Task;

/**
 * Class AuthControllerTest.
 *
 * This class tests the correct behaviour of the Authorization API.
 */
class AuthControllerTest extends TestCase
{
    public static $idUser;
    public static $userData = array();

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
    }

    public function tearDown()
    {
        $user = \App\User::find(static::$idUser);
        if (null !== $user) {
            $user->delete();
        }
        parent::tearDown();
    }

    /**
     * Test authorizeUser.
     */
    public function testAuthorizeUser()
    {
        $authString = base64_encode('test:123');
        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authString,
        );
        $this->get('/api/login', $headers);
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertTrue(array_key_exists('api_token', json_decode($this->response->getContent())));
    }

    /**
     * Test 401 errors in authorizeUser.
     */
    public function testAuthorizeUserKO()
    {
        // No 'Authorization' header.
        $headers = array(
            'Content-Type' => 'application/json',
        );
        $this->get('/api/login', $headers);
        $this->assertEquals(401, $this->response->getStatusCode());

        // Wrong type.
        $authString = base64_encode('test:123');
        $headers['Authorization'] = 'WrongType '.$authString;
        $this->get('/api/login', $headers);
        $this->assertEquals(401, $this->response->getStatusCode());

        // Wrong string.
        $authString = 'WrongString';
        $headers['Authorization'] = 'Basic '.$authString;
        $this->get('/api/login', $headers);
        $this->assertEquals(401, $this->response->getStatusCode());

        // Wrong user.
        $authString = base64_encode('wrongUser:123');
        $headers['Authorization'] = 'Basic '.$authString;
        $this->get('/api/login', $headers);
        $this->assertEquals(401, $this->response->getStatusCode());

        // Wrong password.
        $authString = base64_encode('test:wrongPassword');
        $headers['Authorization'] = 'Basic '.$authString;
        $this->get('/api/login', $headers);
        $this->assertEquals(401, $this->response->getStatusCode());
    }
}