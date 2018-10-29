<?php
namespace WorkPermit\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use WorkPermit\Form\WorkPermitForm;
use Zend\Mvc\MvcEvent;
use DBAL\Entity\WorkPermit\Permit;
use DBAL\Entity\User;
use DBAL\Entity\Profile;
use DBAL\Entity\WorkPermit\PermitSectionItem;
use DBAL\Entity\WorkPermit\SectionItem;
use DBAL\Entity\WorkPermit\Section;
use DBAL\Entity\Personal\Personal;


/**
 * El UserController contendrá la funcionalidad para el manejo de usuario (añadir, editar, cambio de 
 * contraseña, etc).
 */
class WorkPermitContractorController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * User manager.
     * @var User\Service\UserManager 
     */
    protected $workPermitManager;
    
    /**
     * Constructor. 
     */
    protected $profile;

    public function __construct($entityManager, $workPermitManager)
    {
        $this->entityManager = $entityManager;
        $this->workPermitManager = $workPermitManager;
        $this->profile = "contractor";
    }
        
    /**
     * This is the default "index" action of the controller. It displays the 
     * list of users.
     */
    public function indexAction() 
    {
        
        $permits = $this->entityManager->getRepository(Permit::class)
                ->findBy([$this->profile=>$_SESSION['user']]);
        
        return new ViewModel([
            'workPermit' => $permits,
            'statusActived' => Permit::STATUS_ACTIVE,
            'statusWaiting' => Permit::STATUS_WAITING,
        ]);
    } 
    
    

    
    /**
     * The "view" action displays a page allowing to view user's details.
     */
    public function viewAction() 
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Find a user with such ID.
        $workPermit = $this->entityManager->getRepository(Permit::class)
                ->find($id);
        
        if ($workPermit == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
               
        $sections = $this->workPermitManager->getSections($workPermit);
        $personals = $this->workPermitManager->getPersonals($workPermit);
       
        return new ViewModel([
            'workPermit' => $workPermit,
            'sections' => $sections,
            'personals'=> $personals,
        ]);
    }
    
    /**
     * The "edit" action displays a page allowing to edit user.
     */
    public function completeAction() 
    {
       
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
            
        $workPermit = $this->entityManager->getRepository(Permit::class)
                ->find($id);
        
        if ($workPermit == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            $this->workPermitManager->completeWorkPermit($workPermit, $data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('workPermitContractor', 
                        ['action'=>'index', 'id'=>$workPermit->getId()]);                               
        }
        
          //obtiene el contratista que esta registrado
        $contractor = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->identity());
        //la empresa del contratista
        $company = $contractor->getCompany();
        $personal = $this->entityManager->getRepository(Personal::class)
                ->findBy(['company'=>$company[0]]);

        $sections = $this->workPermitManager->getSections($workPermit);
        return new ViewModel(array(
            'workPermit' => $workPermit,
            'sections' => $sections,
            'personal' =>$personal,


        ));
    }
    
    /**
     * This action displays a page allowing to change user's password.
     */
   
}


