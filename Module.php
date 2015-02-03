<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/BsDirectory for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace BsDirectory;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use BsDirectory\Service\ProfileService;
use BsDirectory\Event\Listener\CategoryStrategyListener;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $servicemanager = $e->getApplication()->getServiceManager();
        $bsCategory=$servicemanager->get('bscategory');
        $options=$servicemanager->get('bsdirectory_options');
        $bsCategory->addMapper(ProfileService::DIRECTORY_CATEGORY_KEY,$servicemanager->get('bsdirectory')->getMapper());
        $bsCategory->addStrategyNamespace(__NAMESPACE__.'\Strategy');
        $eventManager->getSharedManager()->attach('BsCategory\Strategy\StrategyAbstractFactory','createService', new CategoryStrategyListener($servicemanager));
        
        
        
    }
}
