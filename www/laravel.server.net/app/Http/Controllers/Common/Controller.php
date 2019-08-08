<?php

namespace App\Http\Controllers\Common;

use App\Kernel\Traits\ApiResponseTrait;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ApiResponseTrait;

    /**
     * 数据响应
     *
     * @param array $data
     * @return array|\Illuminate\Http\Response
     */
    protected function revert(array $data)
    {
        if (is_object($data) && method_exists($data,'toArray')) $data = $data->toArray();

        if(!is_array($data)) $data = (array) $data;

        if(isset($data['code']) && isset($data['data']) && isset($data['module'])) return $data;

        return $this->ok([
            'code'    => '0',
            'message' => 'success!',
            'data'    => $data,
            'time'    => get_now(),
            'module'  => config('service.name'),
        ]);
    }

    /**
     * @return array|\Illuminate\Http\Response
     */
    protected function revertNoContent()
    {
        return $this->revert(null);
    }
}
