<?php
namespace Operation\Service\Factory;

use Interop\Container\ContainerInterface;
use Operation\Service\FormManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class FormManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
                        
        return new FormManager($entityManager);
    }
}