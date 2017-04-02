<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Kadra\Controller\Kadra' => 'Kadra\Controller\KadraController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'kadra' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/kadra[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Kadra\Controller\Kadra',
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
