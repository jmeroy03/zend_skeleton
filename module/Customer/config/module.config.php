<?php
/**
 * Created by PhpStorm.
 * User: jona.e
 * Date: 4/29/2016
 * Time: 10:30 PM
 */
return array(
    'controllers'=> array(
        'invokables' => array(
            'Customer\Controller\Customer' => 'Customer\Controller\CustomerController',
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'customer' => __DIR__ . '/../view',
        ),
    ),

    'router' => array(
        'routes'=>array(
            'customer' =>array(
                'type' => 'Segment',
                'options' =>array(
                    'route' => '/customer[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Customer\Controller\Customer',
                        'action' => 'login',
                    ),
                ),
            )
        )
    )
);
