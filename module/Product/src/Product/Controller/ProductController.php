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
        $viewData = array(
            "products" => $products,
        );

        return new ViewModel($viewData);




    }


}