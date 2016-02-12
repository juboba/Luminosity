<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function setCache($key, $value, $minutes)
    {
        $expired = Carbon::now()->addMinutes($minutes);
        Cache::put($key, $value, $expired);

        return 'Key: ' . $key . ' = ' . $value . '. Expire in ' . $minutes . ' minutes';

    }

    public function getCache($key)
    {
        $value = Cache::get($key);

        return $value;
    }
}
