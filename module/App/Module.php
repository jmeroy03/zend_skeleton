<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace App;

use Zend\Http\Client;
use Zend\Session\Container;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Config\SessionConfig;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Model\ViewModel;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ServiceProviderInterface
{
    
    public function onBootstrap(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // get configurations
        $config = $sm->get('Configuration');

        /**
         * Set app_config to layouts or views.
         */
        $application = $e->getParam('application');
        $viewModel = $application->getMvcEvent()->getViewModel();
        $viewModel->setVariables($config['app_config']);

        /**
         * This method will handle the setting of session sharing configurations
         * and also starting the session manager.
         */

        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions($config['session_cache']);
        $sessionManager = new SessionManager($sessionConfig);
        $sessionManager->start();

    }
    
    /**
     * Get site module config files
     * @return array
     */
    public function getConfig()
    {
        $config = array();

        // get config files
        $configFiles = array(
            __DIR__ . '/config/module.config.php',
            __DIR__ . '/config/module.config.routes.php',
            __DIR__ . '/config/module.config.templates.php',
        );

        // Merge all module config options
        foreach($configFiles as $configFile) {
            $config = ArrayUtils::merge($config, include $configFile);
        }

        return $config;
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

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array()
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'ViewModel' => function() {
                    return new ViewModel();
                }                             
            ),
        );
    }
}