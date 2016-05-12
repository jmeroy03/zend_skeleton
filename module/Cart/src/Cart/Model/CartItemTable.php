<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 5/3/2016
 * Time: 6:30 PM
 */
namespace Cart\Model;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

class CartItemTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function insertItemTable(Cart $Cart)
    {
        $data = array(
            "cart_id" => $Cart->cart_id,
            "product_id" => $Cart->product_id,
            "weight" => $Cart->weight,
            "qty" => $Cart->qty,
            "unit_price" => $Cart->unit_price,
            "price" => $Cart->price,
        );

        $this->tableGateway->insert($data);
        return $this->tableGateway->getLastInsertValue();

    }
    
    public function displayItemToCart($cart_id)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->join(array("p" => "products"), "p.product_id=cart_items.product_id", array("product_thumbnail","product_desc", "product_name"), "left");
        $select->where(array("cart_items.cart_id" => $cart_id));
        $select->group(array("cart_items.product_id"));
        $resultSet = $this->tableGateway->selectWith($select);

        $results = array();
        foreach ($resultSet as $r) {
            $results[] = $r;
        }
               return $results;

    }



    public function existing($product_id,$cart_id)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->where(array('product_id' => $product_id,
                            'cart_id' => $cart_id));
        $resultSet = $this->tableGateway->selectWith($select);

        return $resultSet->current();
        
    }

    public function update(Cart $cart)
    {
        var_dump($cart);
        $result =$this->existing($cart->product_id, $cart->cart_id);
        var_dump($result);

        $updatedWeight = $result->weight + $cart->weight;
        $updatedQty = $result->qty + $cart->qty;
        $updatedPrice = $result->price + $cart->price;

        $data = array(
            'weight' => $updatedWeight,
            'qty' => $updatedQty,
            'price' => $updatedPrice
        );

       $this->tableGateway->update($data,array('product_id' => $cart->product_id,
                                                'cart_id' => $cart->cart_id));
      
    }


    public function sum($cart_id)
    {
        $sum = $this->tableGateway->getSql()->select();
        $sum->columns(array(
            'total_amount' => new Expression('SUM(price)')
        ));

        $sum->where(array('cart_id'=>$cart_id));
        $resultSet = $this->tableGateway->selectWith($sum);
        return $resultSet->current();
    }

    public function deleteCartItem($cart_id)
    {
        $this->tableGateway->delete(array('cart_id' => $cart_id));
    }

}
