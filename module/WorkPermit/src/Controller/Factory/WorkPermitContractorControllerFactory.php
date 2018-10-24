<?php
namespace WorkPermit\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use WorkPermit\Controller\WorkPermitContractorController;
use WorkPermit\Service\WorkPermitManager;

/**
 * This is the factory for UserController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class WorkPermitContractorControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $workPermitManager = $container->get(WorkPermitManager::class);
        
        // Instantiate the controller and inject dependencies
        return new WorkPermitContractorController($entityManager, $workPermitManager);
    }
}