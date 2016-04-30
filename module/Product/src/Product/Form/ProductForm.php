<?php
namespace Product\Form;
use Zend\Form\Form;



/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 4/28/2016
 * Time: 10:28 PM
 */

class ProductForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('product');

        $this->add(array(
            'name' => 'product_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'product_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Product Name'
            ),
        ));
        $this->add(array(
            'name' => 'product_desc',
            'type' => 'Text',
            'options' => array(
                'label' => 'Product Description'
            ),
        ));
    }
}
