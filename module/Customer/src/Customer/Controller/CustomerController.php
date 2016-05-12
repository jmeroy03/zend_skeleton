<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 4/29/2016
 * Time: 11:10 PM
 */
namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CustomerController extends AbstractActionController
{
    public function loginAction()
    {
        $sm = $this->getServiceLocator();
        $CustomerForm = $sm->get('CustomerForm');
        $request = $this->getRequest();
        
        
        if ($request->isPost()) {
            $CustomerFilter = $sm->get('CustomerFilter');

            $CustomerForm->setInputFilter($CustomerFilter);
            $CustomerForm->setData($request->getPost());
            
            if ($CustomerForm->isValid()) {

                $CustomerTable = $sm->get('CustomerTable');


                $email =  $CustomerForm->getInputFilter()->getValue('email');
                $password =  $CustomerForm->getInputFilter()->getValue('password');

                $login=$CustomerTable->login($email, $password);

                if($login==null){
                    echo 'Account does not exist';
                }else{
                    echo 'Account';

                    $Container = $sm->get('Container');
                    $Container->offsetSet('customer_id', $login->customer_id);
                    $Container->offsetSet('first_name', $login->first_name);

                    $this->redirect()->toRoute('home');
                }

            }
        }
        return new ViewModel(array('form' =>$CustomerForm));

    }
    
    public function logoutAction()
    {
        $sm =$this->getServiceLocator();
        $Container = $sm->get('Container');
        unset($Container->first_name);
        unset($Container->customer_id);

        $CartItemTable = $sm->get('CartItemTable');
        $CartTable = $sm->get('CartTable');

        $CartItemTable->deleteCartItem($cart_id);
        $CartTable->deleteCart($cart_id);
        
        unset($Container->cart_id);

        $this->redirect()->toRoute('home');

    }


    public function registerAction()
    {

        $sm = $this->getServiceLocator();
        $RegisterForm = $sm->get('RegisterForm');

        $request = $this->getRequest();

        if ($request->isPost()){
            $RegisterFilter = $sm->get('RegisterFilter');
            $RegisterForm->setInputFilter($RegisterFilter);
            $RegisterForm->setData($request->getPost());

            if ($RegisterForm->isValid()) {
                $Customer = $sm->get('Customer');
                $CustomerTable = $sm->get('CustomerTable');
                $Customer->exchangeArray($RegisterForm->getData());
                $CustomerTable->register($Customer);

                $this->redirect()->toRoute('home');
            }
        }

        return new ViewModel(array('register' =>$RegisterForm));

    }
}

