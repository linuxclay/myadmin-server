<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;
use App\Modules\Example\Business\ExampleBusiness;

/**
 * Ping controller
 *
 */
class ExampleController extends Controller
{
    /**
     * @return array
     */
    public function pong()
    {
        app('Logger')->info('hello world!');
        
        return $this->revert([
            'ping' => 'pong',
        ]);
    }

    public function test(ExampleBusiness $exampleBusiness)
    {
        return $exampleBusiness->example();
    }
}