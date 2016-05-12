<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 4/29/2016
 * Time: 11:26 PM
 */

namespace Customer\Model;

use Zend\Db\TableGateway\TableGateway;

class CustomerTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function login($email,$password)
    {
        $resultSet = $this->tableGateway->select(array('email' => $email ,'password' => $password));
        return  $resultSet->count() > 0 ? $resultSet->current() : null;
    }

    public function register(Customer $Customer)
    {
         $data = array(

             "email" => $Customer->email,
             "password" => $Customer->password,
             "company_name" => $Customer->company_name,
             "first_name" => $Customer->first_name,
             "last_name" => $Customer->last_name
         );
            echo 'gfgsdf';
        $this->tableGateway->insert($data);
        return $this->tableGateway->getLastInsertValue();
    }
}