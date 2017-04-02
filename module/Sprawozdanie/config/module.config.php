<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Sprawozdanie\Controller\Sprawozdanie' => 'Sprawozdanie\Controller\SprawozdanieController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'sprawozdanie' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/sprawozdanie[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Sprawozdanie\Controller\Sprawozdanie',
                        'action' => 'lista',
                    ),
                ),
            ),
            'podglada' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/podglada[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Sprawozdanie\Controller\Sprawozdanie',
                        'action' => 'podglada',
                    ),
                ),
            ),
            'podglads' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/podglads[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Sprawozdanie\Controller\Sprawozdanie',
                        'action' => 'podglads',
                    ),
                ),
            ),
            'podgladd' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/podgladd[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Sprawozdanie\Controller\Sprawozdanie',
                        'action' => 'podgladd',
                    ),
                ),
            ),
            'sprawozdaniePDF' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/sprawozdaniePDF',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Sprawozdanie\Controller\Sprawozdanie',
                        'action' => 'sprawozdaniePDF',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
