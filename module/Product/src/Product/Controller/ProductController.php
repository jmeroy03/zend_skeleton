<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductController extends AbstractActionController
{
    public function indexAction()
    {
        $sm = $this->getServiceLocator();
        $ProductTable = $sm->get('ProductTable');
        //var_dump($ProductTable);
        $products = $ProductTable->fetchAll();


        $Container = $sm->get('Container');
        //$Container->offsetGet('customer_id');
        $first_name = $Container->offsetGet('first_name');
        $this->layout()->setVariable('first_name', $first_name);

       // echo $Container->offsetGet('customer_id');
        //echo $Container->offsetGet('first_name');


        $viewData = array(
            "products" => $products,
        );
        return new ViewModel($viewData);
    }
    
    public function viewAction()
    {



        $product_id = $this->params()->fromRoute('id', 0);
        //var_dump($product_id);

        $sm = $this->getServiceLocator();
        $ProductTable = $sm->get('ProductTable');
        $products = $ProductTable->getProduct($product_id);
       // var_dump($products);

        //Session
        $Container = $sm->get('Container');
        $first_name =  $Container->offsetGet('first_name');
        $this->layout()->setVariable('first_name', $first_name);

        $Container->offsetGet('customer_id');
        //var_dump($Container->offsetGet('first_name'));

        //echo $Container->offsetGet('first_name');

        $viewData = array(
            "products" => $products,
        );

        return new ViewModel($viewData);




    }


}