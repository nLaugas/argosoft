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
        return new ViewModel();
    }

    /**
     * This is the "about" action. It is used to display the "About" page.
     */
    public function aboutAction() 
    {              

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            
            //id del modulo que se presiono 
            $idModuleClick = $data['custId'];
            
            //modulo presionado 
            $modules =$this->entityManager->getRepository(Module::class)
                    ->findOneBy( array('id'=>$idModuleClick));
            
            $operations = $modules->getOperations();
            $this->redirect()->toRoute($operations[0]->getRoute());
            //$this->redirect()->toRoute('operations');
        }



        //obtiene el usuario que esta registrado
        $userLog = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->identity());

        //obtiene los perfiles del usuario
        $profiles = $userLog->getProfiles();
        
        //obtiene los modulos del perfil primer perfil 
        $modules = $profiles[0]->getModules();    
                    /*
                    foreach ($modules as  $m) {
                        echo $m->getName();
                    }
                    die(__FILE__);
        */
        // Return variables to view script with the help of
        // ViewObject variable container

        return new ViewModel([
            'profileName' => $profiles[0]->getName(),
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

