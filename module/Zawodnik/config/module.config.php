<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Zawodnik\Controller\Zawodnik' => 'Zawodnik\Controller\ZawodnikController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'zawodnik' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/zawodnik[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Zawodnik\Controller\Zawodnik',
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
