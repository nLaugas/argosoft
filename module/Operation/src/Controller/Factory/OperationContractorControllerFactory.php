<?php
namespace Operation\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Operation\Controller\OperationContractorController;
use Operation\Service\FormManager;

class OperationContractorControllerFactory implements FactoryInterface {
    

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $formManager = $container->get(FormManager::class);
       
        // Instantiate the service and inject dependencies
        return new OperationContractorController($entityManager, $formManager);
    }    
}
