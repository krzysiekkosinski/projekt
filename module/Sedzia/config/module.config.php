<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Sedzia\Controller\Sedzia' => 'Sedzia\Controller\SedziaController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'sedzia' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/sedzia[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Sedzia\Controller\Sedzia',
                        'action' => 'lista',
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
