<?php

namespace App\Kernel\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * 数据处理基类
 *
 */
abstract class BaseDao
{
    /**
     * @var array
     */
    protected $selectColumns = ['*'];
    
    /**
     * @return Model
     */
    abstract protected function getModel() : Model;

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->getModel()->destroy($id);
    }

    /**
     * @param array $columns
     * @return array
     */
    public function getSelectColumns(array $columns = []) : array
    {
        return $columns ?: $this->selectColumns;
    }
}