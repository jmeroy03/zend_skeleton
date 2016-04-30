<?php
    return array(
        'controllers' => array(
            'invokables' => array(
                'Product\Controller\Product' => 'Product\Controller\ProductController',
            )
        ),
        'view_manager'=> array(
            'template_path_stack' => array(
                'products' => __DIR__ . '/../view',
            ),
        ),
        'router' => array(
            'routes' => array(
                'product' => array(
                    'type' => 'Segment',
                    'options' => array(
                        'route' => '/product[/:action][/:id]',
                        'constraints' => array(
                            'actions' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id' => '[0-9]+',
                        ),
                        'defaults' => array(
                            'controller' => 'Product\Controller\Product',
                            'action' => 'index',
                        ),
                    ),
                )
            )
        )
    );