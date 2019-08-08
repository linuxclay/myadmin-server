<?php

namespace App\Exceptions;

/**
 * 示例异常信息
 *
 * @notice 错误码为6位数，以数字 5 开头
 */
class ExampleException extends BaseException
{
    protected static $codeMaps = [
        500000 => [
            'message' => 'something wrong.',
        ],
    ];
}