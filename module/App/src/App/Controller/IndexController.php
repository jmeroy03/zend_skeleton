<?php
namespace App\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

/**
  * Index Controller
  * @author Emmanuel Sayson <emmanuel.s@uprinting.com>
  */
class IndexController extends AbstractActionController
{
    
    /**
     * This method is for displaying the homepage.
     * @return array|ViewModel
     */
    public function viewAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables(array('title' => 'THIS IS A SKELETON ZEND APP'));
        $viewModel->setTemplate('INDEX');

        return $viewModel;    
    }
    
}