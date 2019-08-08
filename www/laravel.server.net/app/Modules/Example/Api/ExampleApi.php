<?php

namespace App\Modules\Example\Api;

use App\Kernel\Base\BaseApi;

/**
 * 示例 api 请求
 *
 */
class ExampleApi extends BaseApi
{

    /**
     * @return string
     */
    protected function signature(): string
    {
        return 'example';
    }

    /**
     * @return bool
     */
    protected function authorize(): bool
    {
        return false;
    }
    
    /**
     * 返回配置
     */
    protected function getConfig() :array
    {
        return config('api.example');
    }

    /**
     * Ping
     *
     * @throws \App\Exceptions\ApiException
     * @throws \App\Exceptions\ApiRequestException
     * @throws \App\Exceptions\RuntimeException
     */
    public function ping()
    {
        return $this->get($this->apiList['ping']);
    }
    
}