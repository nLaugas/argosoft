<?php
namespace Personal\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Personal\Controller\PersonalController;
use Personal\Service\PersonalManager;

/**
 * This is the factory for UserController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PersonalControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $personalManager = $container->get(PersonalManager::class);
        
        // Instantiate the controller and inject dependencies
        return new PersonalController($entityManager, $personalManager);
    }
}