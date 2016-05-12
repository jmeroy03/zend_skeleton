<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 5/3/2016
 * Time: 5:30 PM
 */
namespace Cart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class CartController extends AbstractActionController
{
    public function indexAction()
    {
       $sm = $this->getServiceLocator();
        $Container = $sm->get('Container');
        $cart_id = $Container->offsetGet('cart_id');
        $CartItemTable = $sm->get('CartItemTable');
        $item = $CartItemTable->displayItemToCart($cart_id);
        $subtotal = $CartItemTable->sum($cart_id);

        $Container = $sm->get('Container');
        $first_name= $Container->offsetGet('first_name');
        $this->layout()->setVariable('first_name', $first_name);

        $view = array(
          'item' => $item,
            'subtotal'=> $subtotal->total_amount
        );

        return new ViewModel($view);
    }
    
    public function addtocartAction()
    {
        $sm = $this->getServiceLocator();
        $Container = $sm->get('Container');
        $cart_id = $Container->offsetGet('cart_id');
       
        if(!isset($cart_id)){
            $CartTable = $sm->get('CartTable');
            $lastInserted = $CartTable->insertCartTable();
            $Container->offsetSet('cart_id', $lastInserted);
        }

        $Cart = $sm->get('Cart');

        $CartItemTable = $sm->get('CartItemTable');
        $request = $this->getRequest();

        if ($CartItemTable->existing($request->getPost('hiddenProdID'), $cart_id)) {
            $Cart->cart_id = $cart_id;
            $Cart->product_id = $request->getPost('hiddenProdID');
            $Cart->unit_price = $request->getPost('hiddenUnitPrice');
            $Cart->price = $request->getPost('hiddenPrice');
            $Cart->weight = $request->getPost('hiddenWeight');
            $Cart->qty = (Int)$request->getPost('hiddenQty');
            $CartItemTable->update($Cart);


        }else {
            $this->insertItemToCart($Container->cart_id);
        }


        $this->redirect()->toRoute('cart');
    }


    public function insertItemToCart($cart_id)
    {

        $sm = $this->getServiceLocator();
        $Cart = $sm->get('Cart');
        $CartItemTable = $sm->get('CartItemTable');

        
        $request = $this->getRequest();
        $Cart->cart_id = $cart_id;
        $Cart->product_id = $request->getPost('hiddenProdID');
        $Cart->unit_price = $request->getPost('hiddenUnitPrice');
        $Cart->price = $request->getPost('hiddenPrice');
        $Cart->weight = $request->getPost('hiddenWeight');
        $Cart->qty = (Int)$request->getPost('hiddenQty');
        $CartItemTable->insertItemTable($Cart);

    }

}
