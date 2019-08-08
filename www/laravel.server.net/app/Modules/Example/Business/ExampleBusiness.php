<?php

namespace App\Modules\Example\Business;

use App\Kernel\Base\BaseBusiness;
use App\Modules\Example\Api\ExampleApi;
use App\Modules\Example\Dao\ExampleDao;
use App\Modules\Example\Invoke\ExampleInvoke;

/**
 * 测试业务
 *
 */
class ExampleBusiness extends BaseBusiness
{
    /**
     * @var ExampleDao
     */
    protected $exampleDao;
    
    /**
     * @var ExampleApi
     */
    protected $exampleApi;
    
    /**
     * @var ExampleInvoke
     */
    protected $exampleInvoke;

    /**
     * ExampleBusiness constructor.
     *
     * @param ExampleDao $exampleDao
     * @param ExampleApi $exampleApi
     * @param ExampleInvoke $exampleInvoke
     */
    public function __construct(
        ExampleDao $exampleDao,
        ExampleApi $exampleApi,
        ExampleInvoke   $exampleInvoke
    )
    {
        $this->exampleDao = $exampleDao;
        $this->exampleApi = $exampleApi;
        $this->exampleInvoke = $exampleInvoke;
    }
    
    /**
     * 实例方法
     */
    public function example()
    {
        //dao
        //$this->exampleDao->find();
        
        //api
        //$this->exampleApi->ping();
        
        //invoke
        //$this->exampleInvoke->example();
    }
    
}