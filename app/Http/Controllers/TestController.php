<?php

/**
 * Controller for testing.
 *
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AAres\UserNaming\UserNaming;

/**
 * Class TaskController.
 * Controller for Task API.
 *
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    /**
     * This is a random method to test whatever we want.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function test()
    {
        $randomName = UserNaming::generate();
        $result = array(
            'test' => $randomName,
        );

        return response()->json($result);
    }
}
