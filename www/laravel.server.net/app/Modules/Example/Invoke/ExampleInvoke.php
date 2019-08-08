<?php

namespace App\Modules\Example\Invoke;

use App\Kernel\Base\BaseInvoke;

/**
 * 示例跨模块调用
 */
class ExampleInvoke extends BaseInvoke
{
    
    /**
     * @Var UserBusiness
     */
    protected $userBusiness;
    
    /**
     * ExampleInvoke constructor.
     * @param UserBusiness $userBusiness\
     */
//    public function __construct(UserBusiness $userBusiness)
//    {
//        $this->userBusiness = $userBusiness;
//    }
    
    /**
     * 示例方法
     */
    public function example()
    {
        //$this->userBusiness->example();
    }

}
