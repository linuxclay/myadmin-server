<?php

namespace App\Exceptions;

use Exception;

/**
 * 程序异常信息基类
 *
 */
class BaseException extends Exception
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var array
     */
    protected $data;
    
    /**
     * @var array
     */
    protected $map = array();

    /**
     * @var array
     */
    protected static $codeMaps = [];

    /**
     * BaseException constructor.
     * @param $code
     * @param $data
     */
    public function __construct($code, array $data = [])
    {
        $code    = (int)$code;
        $map     = $this->getCodeMap($code);
        $message = array_get($map, 'message', '');

        $this->code = $code;
        $this->data = $data;
        $this->map  = $map;

        parent::__construct($message, $this->code);
    }

    /**
     * @return array
     */
    public function all() : array
    {
        return [
            'code'    => $this->getCode(),
            'message' => $this->getMessage(),
            'data'    => $this->getData() ?: null,
            'time'    => get_now(),
            'module'  => config('service.name'),
        ];
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        return (array)$this->data;
    }

    /**
     * @param int $code
     * @return array
     */
    public function getCodeMap(int $code) : array
    {
        return array_get(static::getCodeMaps(), $code, []);
    }
    
    /**
     * 是否记录异常
     */
    public function needReport() : bool
    {
        return array_get($this->map, 'report', true);
    }

    /**
     * @return array
     */
    public static function getCodeMaps(): array
    {
        return static::$codeMaps;
    }
}
