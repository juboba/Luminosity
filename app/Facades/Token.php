<?php

/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 19.02.2016
 * Time: 14:38
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Service\TokenService;

/**
 * Class Token.
 *
 * @package App\Facades
 */
class Token extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string Service class name.
     */
    protected static function getFacadeAccessor()
    {
        return TokenService::class;
    }
}
