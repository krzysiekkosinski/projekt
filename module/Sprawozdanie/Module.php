<?php

namespace Sprawozdanie;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Sprawozdanie\Model\Sprawozdanie;
use Sprawozdanie\Model\SprawozdanieTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Sprawozdanie\Model\SprawozdanieTable' => function($sm) {
                    $tableGateway = $sm->get('SprawozdanieTableGateway');
                    $table = new SprawozdanieTable($tableGateway);
                    return $table;
                },
                'SprawozdanieTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Sprawozdanie());
                    return new TableGateway('sprawozdanie', $dbAdapter, null, $resultSetPrototype);
                },
                'Mecz\Model\MeczTable' => function($sm) {
                    $tableGateway = $sm->get('MeczTableGateway');
                    $table = new MeczTable($tableGateway);
                    return $table;
                },
                'MeczTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Mecz());
                    return new TableGateway('mecz', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
