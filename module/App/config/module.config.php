<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
/**
 * This config is for view scripts, layouts, sections and pixels.
 */
return array(    
    'controllers' => array(
        'invokables' => array(
            'App\Controller\App' => 'App\Controller\AppController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'app' => __DIR__ . '/../view',
        ), 
    ),
    
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'session_vars'  => array(
        'namespace' => array("Zend_Auth"),
    ),
);

