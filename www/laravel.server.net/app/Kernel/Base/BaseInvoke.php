<?php

namespace App\Kernel\Base;

/**
 * 跨模块/业务通信基类
 *
 */
class BaseInvoke
{
    /**
     * @param array $data
     * @return array
     */
    protected function response(array $data) : array
    {
        return $data;
    }
}