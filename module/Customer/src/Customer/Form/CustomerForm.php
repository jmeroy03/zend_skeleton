<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 4/30/2016
 * Time: 1:27 AM
 */
namespace Customer\Form;
use Zend\Form\Form;



class CustomerForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('login');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => 'Email',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
            ),
        ));
        

        

    }
}