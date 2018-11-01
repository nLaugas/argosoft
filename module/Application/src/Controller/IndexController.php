<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Barcode\Barcode;
use Zend\Mvc\MvcEvent;
use DBAL\Entity\User;
use DBAL\Entity\Profile;
use DBAL\Entity\Module;
use DBAL\Entity\Operation;
use DBAL\Entity\Tab;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class IndexController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private $userLog;
    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager) 
    {
       $this->entityManager = $entityManager;

    }
    
    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() 
    {
        $this->redirect()->toRoute('login');
        return new ViewModel();

    }

    /**
     * This is the "about" action. It is used to display the "About" page.
     */
    public function modulesAction() 
    {              
        $id = (int)$this->params()->fromRoute('id', -1);
        $modules = null;
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            
            //id del modulo que se presiono 
            $idModuleClick = $data['custId'];
            
            //modulo presionado 
            $module =$this->entityManager->getRepository(Module::class)
                    ->findOneBy( array('id'=>$idModuleClick));
            
            
            if ($module->getRoute() != NULL){
                $this->redirect()->toRoute($module->getRoute());
            }
            else
            {                
                $this->redirect()->toRoute('modules', ['id'=>$idModuleClick]);
            }

        }

        

        if ($id < 0){
            //obtiene el usuario que esta registrado
            $userLog = $this->entityManager->getRepository(User::class)
                        ->findOneByEmail($this->identity());

            //obtiene los perfiles del usuario
            $profiles = $userLog->getProfiles();
            
            //agrega el perfil y usuario en la variable global
            $_SESSION['profile'] = $profiles[0];
            $_SESSION['user'] = $userLog; 

            //obtiene los modulos del primer perfil 
            $modules = $profiles[0]->getModules();   
         
        }
        else
        {
            $module = $this->entityManager->getRepository(Module::class)
                    ->findOneBy( ['id'=>$id]);
            $modules = $this->entityManager->getRepository(Module::class)
                    ->findBy(['fatherModule'=>$module]);

        }

        return new ViewModel([
            'profileModules' => $modules,
        ]);
    }  
    
    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction()
    {
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($this->identity());
        
        if ($user==null) {
            throw new \Exception('Not found user with such email');
        }
        
        return new ViewModel([
            'user' => $user
        ]);
    }
}

