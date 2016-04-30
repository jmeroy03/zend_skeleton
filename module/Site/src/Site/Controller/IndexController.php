<?php

namespace Site\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}