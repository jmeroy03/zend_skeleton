<?php

namespace Customer;

use Customer\Filter\CustomerFilter;
use Customer\Filter\RegisterFilter;
use Customer\Form\CustomerForm;
use Customer\Form\RegisterForm;
use Customer\Model\Customer;
use Customer\Model\CustomerTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Session\Container;

class Module
{


    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'CustomerTable' => function ($sm) {
                    $CustomerTableGateway = $sm->get('CustomerTableGateway');
                    return new CustomerTable($CustomerTableGateway);
                },
                'CustomerTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Customer());
                    return new TableGateway('customers', $dbAdapter, null, $resultSetPrototype);
                },
                'Customer' => function () {
                    return new Customer();
                },
                'CustomerForm' => function () {
                    return new CustomerForm();
                },
                'CustomerFilter' => function () {
                    return new CustomerFilter();
                },
                'Container' => function () {
                    return new Container();
                },

                'RegisterForm' => function(){
                    return new RegisterForm();
                },

                'RegisterFilter' => function (){
                    return new RegisterFilter();
                }

            )
        );
    }


}