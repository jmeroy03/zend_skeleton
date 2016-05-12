<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 5/3/2016
 * Time: 5:35 PM
 */
namespace Cart\Model;

class  Cart
{

    public $cart_item_id;
    public $cart_id;
    public $product_id;
    public $weight;
    public $qty;
    public $unit_price;
    public $price;
    

    public $customer_id;
    public $order_datetime;
    public $sub_total;
    public $taxable_amount;
    public $discount;
    public $tax;
    public $shipping_total;
    public $total_amount;
    public $total_weight;
    public $company_name;
    public $email;
    public $first_name;
    public $last_name;
    public $shipping_name;
    public $shipping_address1;
    public $shipping_address2;
    public $shipping_address3;
    public $shipping_city;
    public $shipping_country;

    public $product_name;
    public $product_desc;
    public $product_thumbnail;


    public function exchangeArray($cart)
    {

        $this->cart_item_id = (!empty($cart['cart_item_id'])) ? $cart['cart_item_id'] : null;
        $this->product_id = (!empty($cart['product_id'])) ? $cart['product_id'] : null;
        $this->weight = (!empty($cart['weight'])) ? $cart['weight'] : null;
        $this->qty = (!empty($cart['qty'])) ? $cart['qty'] : null;
        $this->unit_price = (!empty($cart['unit_price'])) ? $cart['unit_price'] : null;
        $this->price = (!empty($cart['price'])) ? $cart['price'] : null;
        
        $this->cart_id = (!empty($cart['cart_id'])) ? $cart['cart_id'] : null;
        $this->customer_id = (!empty($cart['customer_id'])) ? $cart['customer_id'] : null;
        $this->order_datetime = (!empty($cart['order_datetime'])) ? $cart['order_datetime'] : null;
        $this->sub_total = (!empty($cart['sub_total'])) ? $cart['sub_total'] : null;
        $this->taxable_amount = (!empty($cart['taxable_amount'])) ? $cart['taxable_amount'] : null;
        $this->discount = (!empty($cart['discount'])) ? $cart['discount'] : null;
        $this->tax = (!empty($cart['tax'])) ? $cart['tax'] : null;
        $this->shipping_total = (!empty($cart['shipping_total'])) ? $cart['shipping_total'] : null;
        $this->total_amount = (!empty($cart['total_amount'])) ? $cart['total_amount'] : null;
        $this->total_weight = (!empty($cart['total_weight'])) ? $cart['total_weight'] : null;
        $this->company_name = (!empty($cart['company_name'])) ? $cart['company_name'] : null;
        $this->email = (!empty($cart['email'])) ? $cart['email'] : null;
        $this->first_name = (!empty($cart['first_name'])) ? $cart['first_name'] : null;
        $this->last_name = (!empty($cart['last_name'])) ? $cart['last_name'] : null;
        $this->shipping_mehod = (!empty($cart['shipping_mehod'])) ? $cart['shipping_mehod'] : null;
        $this->shipping_name = (!empty($cart['shipping_name'])) ? $cart['shipping_name'] : null;
        $this->shipping_address1 = (!empty($cart['shipping_address1'])) ? $cart['shipping_address1'] : null;
        $this->shipping_address2 = (!empty($cart['shipping_address2'])) ? $cart['shipping_address2'] : null;
        $this->shipping_address3 = (!empty($cart['shipping_address3'])) ? $cart['shipping_address3'] : null;
        $this->shipping_city = (!empty($cart['shipping_city'])) ? $cart['shipping_city'] : null;
        $this->shipping_state = (!empty($cart['shipping_state'])) ? $cart['shipping_state'] : null;
        $this->shipping_country = (!empty($cart['shipping_total'])) ? $cart['shipping_country'] : null;
        $this->product_name = (!empty($cart['product_name'])) ? $cart['product_name'] : null;
        $this->product_desc = (!empty($cart['product_desc'])) ? $cart['product_desc'] : null;
        $this->product_thumbnail = (!empty($cart['product_thumbnail'])) ? $cart['product_thumbnail'] : null;


    }
    public function getArrayCopy(){
        return get_object_vars($this);
    }
}

