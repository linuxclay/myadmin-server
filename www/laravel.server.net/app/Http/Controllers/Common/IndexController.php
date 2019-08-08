<?php

namespace App\Http\Controllers\Common;

/**
 * 通用控制器
 *
 */
class IndexController extends Controller
{
    /**
     * @return array
     */
    public function now()
    {
        return $this->revert([
            'now'      => get_now(),
            'timezone' => config('app.timezone'),
        ]);
    }
}