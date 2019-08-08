<?php

namespace App\Modules\Example\Dao;

use App\Kernel\Base\BaseDao;
use App\Modules\Example\Model\Example;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 */
class ExampleDao extends BaseDao
{
    protected function getModel() :Model
    {
        return app(Example::class);
    }
}
