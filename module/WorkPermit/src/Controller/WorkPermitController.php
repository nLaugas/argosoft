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


/**
 * El UserController contendrá la funcionalidad para el manejo de usuario (añadir, editar, cambio de 
 * contraseña, etc).
 */
class WorkPermitController extends AbstractActionController 
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * User manager.
     * @var User\Service\UserManager 
     */
    private $workPermitManager;
    
    /**
     * Constructor. 
     */
    protected $isContractor;
    
    public function __construct($entityManager, $workPermitManager)
    {
        $this->entityManager = $entityManager;
        $this->workPermitManager = $workPermitManager;
        $this->isContractor = false;
    }
        
    /**
     * This is the default "index" action of the controller. It displays the 
     * list of users.
     */
    public function indexAction() 
    {
        
        
            
        //obtiene el usuario que puede ser contratista o interno responsable
        
        $user = $_SESSION['user'];
        $profile = $user->getProfiles()[0];
        $isContractor = false;             
        if ($profile->getName() == Profile::PROFILE_CONTRACTOR){
            $permits = $this->entityManager->getRepository(Permit::class)
                ->findBy(['contractor'=>$user]);
                $isContractor = true;
        }
        else
        {
            $permits = $this->entityManager->getRepository(Permit::class)
                ->findBy(['performer'=>$user]);       
        }
        

        return new ViewModel([
            'workPermit' => $permits,
            'isContractor'=>$isContractor,
        ]);
    } 
    
    /**
     * This action displays a page allowing to add a new user.
     */



    public function addAction()
    {
        
         

        $form = new WorkPermitForm('create', $this->entityManager);
        // Check if user has submitted the form

        $allContractors  = $this->entityManager->getRepository(User::class)
                ->findBy([], ['fullName'=>'ASC']);
        $contractorList = [];
        foreach ($allContractors as $contractor) {
            $contractorList[$contractor->getId()] = $contractor->getFullName();
        }
        
        $form->get('contractor')->setValueOptions($contractorList);
        //usuario que crea el permiso 
         $performer = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->identity());
        

        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            print_r($this->params()->fromFiles());
            die(__FILE__);
            $form->setData($data);
            // Validate form

            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                // Add user.
                $data['performer'] = $performer;
                $workPermit = $this->workPermitManager->addWorkPermit($data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('workPermit', 
                        ['action'=>'view', 'id'=>$workPermit->getId()]);                
            }               
        } 
        
        return new ViewModel([
                'form' => $form
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
               
        return new ViewModel([
            'workPermit' => $workPermit
        ]);
    }
    
    /**
     * The "edit" action displays a page allowing to edit user.
     */
    public function editAction() 
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
        // Create user form
        $form = new WorkPermitForm('update', $this->entityManager, $workPermit);
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Update the user.
                $this->workPermitManager->updateWorkPermit($workPermit, $data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('workPermit', 
                        ['action'=>'view', 'id'=>$workPermit->getId()]);                
            }               
        } else {

            
            $form->setData(array(
                    'start-time'=>$workPermit->getStartTime(),
                    'end-time'=>$workPermit->getEndtime(),                    
                    'work-reason'=>$workPermit->getWorkReason(),                    
                ));
        }
        $user = $_SESSION['user'];
        $profile = $user->getProfiles()[0];
        $isContractor = false;             
        if ($profile->getName() == Profile::PROFILE_CONTRACTOR){
            $sections = $this->workPermitManager->getSections($workPermit);
                $isContractor = true;
        }
        
        
        return new ViewModel(array(
            'workPermit' => $workPermit,
            'form' => $form,
            'sections' => $sections,
            'isContractor' => $isContractor,
        ));
    }
    
    /**
     * This action displays a page allowing to change user's password.
     */
   
}


