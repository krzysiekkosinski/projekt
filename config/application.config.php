<?php

return array(
    'modules' => array(
        'Application',
        'Sprawozdanie',
      //  'Podglad',
        'Mecz',
        'Kadra',
        'Zawodnik',
        'Sedzia',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            __DIR__ . '/autoload/{,*.}{global,local}.php',
        ),
    ),
);


