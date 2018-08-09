<?php
namespace Operation\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Operation\Controller\OperationController;

/**
 * Description of OperationControllerFactory
 *
 * @author mariano
 */
class OperationControllerFactory implements FactoryInterface {
    

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        
       
        // Instantiate the service and inject dependencies
        return new OperationController($entityManager);
    }    
}
