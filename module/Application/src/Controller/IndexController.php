<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DBAL\Entity\Usuario;
use DBAL\Entity\Perfil;


class IndexController extends AbstractActionController
{    
    protected $em;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
    public function cargaAction()
    {
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost(); 
            $this->registrarUsuarioPerfil($data);
        } 
        
        $perfiles = $this->getEntityManager()
                ->getRepository(Perfil::class)->findAll();
        
        $usuarios = $this->getEntityManager()
                ->getRepository(Usuario::class)->findAll();  
        
        return new ViewModel(['usuarios' => $usuarios, 
                              'perfiles'=>$perfiles]);
    }
    
    private function registrarUsuarioPerfil($datos)
    {
        $usuarioId = $datos['usuario'];
        $perfilId = $datos['perfil'];
        
        $usuario = $this->getEntityManager()
                ->find(Usuario::class, $usuarioId);
               
        $perfil = $this->getEntityManager()
                ->find(Perfil::class, $perfilId);
       
        $usuario->addPerfil($perfil);
        $perfil->addUsuario($usuario);
        
  
        $this->getEntityManager()
                        ->flush();
    } 
}
