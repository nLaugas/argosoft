<?php
namespace Perfil\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Perfil\Controller\PerfilController;

/**
 * Description of UsuarioControllerFactory
 *
 * @author 
 */
class PerfilControllerFactory implements FactoryInterface {
    

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        
       
        // Instantiate the service and inject dependencies
        return new PerfilController($entityManager);
    }    
}
