<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 5/2/2016
 * Time: 11:26 PM
 */
namespace Customer\Form;
use Zend\Form\Form;



class RegisterForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('register');

        $this->add(array(
            'name' => 'customer_id',
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
            'name' => 'confirmPassword',
            'type' => 'password',
            'options' => array(
                'label' => 'Confirm Password',
            ),
        ));

        $this->add(array(
        'name' => 'company_name',
        'type' => 'Text',
        'options' => array(
            'label' => 'Company Name',
        ),
    ));
        $this->add(array(
            'name' => 'first_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'First Name',
            ),
        ));
        $this->add(array(
            'name' => 'last_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Last Name',
            ),
        ));
        $this->add(array(
            'name' => 'register',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
            ),
        ));
    }
}