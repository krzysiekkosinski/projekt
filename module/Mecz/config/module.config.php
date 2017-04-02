<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Mecz\Controller\Mecz' => 'Mecz\Controller\MeczController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'mecz' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/mecz[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Mecz\Controller\Mecz',
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
