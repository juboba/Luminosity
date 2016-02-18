<?php

/**
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

// artisan queue:listen --queue=tasks
// curl -i -X POST -H "Content-Type:application/json" http://localhost:80/api/v0_01/tasks -d '{"name":"Lumen Jobs","description":"Learn to implement jobs", "language_id":"1"}'

namespace app\Jobs;

use Illuminate\Http\Request;
use App\Country;
use App\Language;
use App\User;

/**
 * Class CreateTaskJob.
 */
class CreateTaskJob extends Job
{
    /**
     * @var array Parameters received with the request.
     */
    protected $requestParams;

    /**
     * CreateTaskJob constructor.
     *
     * @param array $requestParams
     */
    public function __construct(array $requestParams)
    {
        $this->requestParams = $requestParams;
    }

    /**
     * Execute the job.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle()
    {
        // Language.
        $language = Language::findOrNew(1);
        if (!$language->id) {
            $language->id = 1;
            $language->name = 'english';
            $language->prefix = 'en';
            $language->save();
        }
        // Country.
        $country = Country::findOrNew(1);
        if (!$country->id) {
            $country->id = 1;
            $country->name = 'spain';
            $country->prefix = 'spa';
            $country->save();
        }
        // User.
        $user = User::findOrNew(1);
        if (!$user->id) {
            $user->id = 1;
            $user->name = 'Test';
            $user->surname = 'Test';
            $user->email = 'test@test.com';
            $user->direction = 'this should be called address lol';
            $user->birthday = '2000-01-01';
            $user->language_id = $language->id;
            $user->country_id = $country->id;
            $user->save();
        }
        $created = $user->tasks()->create($this->requestParams);

        return response()->json($created);
    }
}
