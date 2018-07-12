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
        return new ViewModel([
        ]);
    }
    public function cargaAction()
    {
        $usuarioSelect = "nada"; 
        if ($this->getRequest()->isPost()) 
        {
            $data = $this->params()->fromPost(); 
            $usuarioId = $data['usuario'];
            $usuarioSelect =   $this->getEntityManager()->getRepository(Usuario::class)->find($usuarioId).getPerfiles(); //servicio- perfiles(id)
        }     
        $usuarios = $this->getEntityManager()
        ->getRepository(Usuario::class)->findAll();   
              
        $perfiles = $this->getEntityManager()
        ->getRepository(Perfil::class)->findAll();   
                
        return new ViewModel(['usuarios' => $usuarios,
                              'usuarioSelec'=>$usuarioSelect,
                              'perfiles' => $perfiles
                            ]);
    }
}
