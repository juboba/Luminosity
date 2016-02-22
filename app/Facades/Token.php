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

class Token extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TokenService::class;
    }
}