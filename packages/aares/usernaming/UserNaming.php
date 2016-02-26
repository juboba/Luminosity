<?php

/**
 * UserNaming facade class.
 *
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace AAres\UserNaming;

use Illuminate\Support\Facades\Facade;
use AAres\UserNaming\UserNamingService;

/**
 * Class UserNaming.
 *
 * @package AAres\UserNaming
 */
class UserNaming extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string Service class name.
     */
    protected static function getFacadeAccessor()
    {
        return UserNamingService::class;
    }
}
