<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace WorkPermit;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;

class Module
{
    /**
     * This method returns the path to module.config.php file.
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    /**
     * This method is called once the MVC bootstrapping is complete and allows
     * to register event listeners. 
     */
     public function onBootstrap(MvcEvent $event)
    {
        $application = $event->getApplication();
        $application->getEventManager()->attach(MvcEvent::EVENT_DISPATCH, [$this, 'setLayout'], -100); // - postDispach , + presDispach
        
    }

    public function setLayout($e) {
        $matches = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        
        if (0 !== strpos($controller, __NAMESPACE__, 0)) {
        // NO es un controlador del modulo y no es la action login
        return;
        }
        // Cambia el layout
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/layout1');
    }
}
