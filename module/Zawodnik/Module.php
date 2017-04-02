<?php

namespace Zawodnik;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zawodnik\Model\Zawodnik;
use Zawodnik\Model\ZawodnikTable;
use Kadra\Model\Kadra;
use Kadra\Model\KadraTable;
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
                'Zawodnik\Model\ZawodnikTable' => function($sm) {
                    $tableGateway = $sm->get('ZawodnikTableGateway');
                    $table = new ZawodnikTable($tableGateway);
                    return $table;
                },
                'ZawodnikTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Zawodnik());
                    return new TableGateway('zawodnik', $dbAdapter, null, $resultSetPrototype);
                },
                'Kadra\Model\KadraTable' => function($sm) {
                    $tableGateway = $sm->get('KadraTableGateway');
                    $table = new KadraTable($tableGateway);
                    return $table;
                },
                'KadraTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Kadra());
                    return new TableGateway('zespol', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
