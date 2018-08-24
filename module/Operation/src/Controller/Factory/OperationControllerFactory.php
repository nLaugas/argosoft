<?php
namespace Operation\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Operation\Controller\OperationController;
use Operation\Service\FormManager;

class OperationControllerFactory implements FactoryInterface {
    

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $formManager = $container->get(FormManager::class);
       
        // Instantiate the service and inject dependencies
        return new OperationController($entityManager, $formManager);
    }    
}
