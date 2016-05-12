<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 5/3/2016
 * Time: 5:27 PM
 */
namespace Cart;

use Cart\Model\Cart;
use Cart\Model\CartItemTable;
use Cart\Model\CartTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Session\Container;


class Module
{
    public function getConfig()
    {
        return include __DIR__ .'/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__=>__DIR__. '/src/' . __NAMESPACE__,
                ),
            ) ,
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'CartTable' => function ($sm){
                    $CartTableGateway = $sm->get('CartTableGateway');
                    return new CartTable($CartTableGateway);
                },
                'CartTableGateway' => function ($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype ->setArrayObjectPrototype(new Cart());
                    return new TableGateway('carts', $dbAdapter, null,$resultSetPrototype);
                },
                'CartItemTable' => function ($sm){
                    $CartTableGateway = $sm->get('CartItemTableGateway');
                    return new CartItemTable($CartTableGateway);
                },
                'CartItemTableGateway' => function ($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype ->setArrayObjectPrototype(new Cart());
                    return new TableGateway('cart_items', $dbAdapter, null,$resultSetPrototype);
                },
                'Cart' => function(){
                    return new Cart();
                },
                'Container' => function(){
                    return new Container();
                }

            )
        );
    }
}