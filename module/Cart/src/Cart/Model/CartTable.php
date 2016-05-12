<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 5/3/2016
 * Time: 6:30 PM
 */
namespace Cart\Model;
use Zend\Db\TableGateway\TableGateway;

class CartTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function insertCartTable()
    {
        $data = array(
           
            "customer_id" => 0,
            "order_datetime" => date('Y-m-d h:i:s'),
            "sub_total" => 0,
            "taxable_amount" => 0,
            "discount" => 0,
            "tax" => 0.0,
            "shipping_total" => 0.00,
            "total_amount" => 0.00,
            "total_weight" => 0,
            "company_name" => " ",
            "email" => " ",
            "first_name" => " ",
            "last_name" => " ",
            "shipping_mehod" => " ",
            "shipping_name" => " ",
            "shipping_address1" => " ",
            "shipping_address2" => " ",
            "shipping_address3" => " ",
            "shipping_city" => " ",
            "shipping_state" => " ",
            "shipping_country" => " "
        );


        $this->tableGateway->insert($data);
        return $this->tableGateway->getLastInsertValue();
        

    }
    public function deleteCart($cart_id)
    {
         $this->tableGateway->delete(array('cart_id' => $cart_id));
    }


}
