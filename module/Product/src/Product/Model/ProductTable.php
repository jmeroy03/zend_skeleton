<?php

namespace Product\Model;

use Zend\Db\TableGateway\TableGateway;

class ProductTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {

        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getProduct($product_id)
    {
        $resultSet = $this->tableGateway->select(array('product_id' => $product_id));
        return $resultSet->count() > 0 ? $resultSet->current() : null;

    }

}