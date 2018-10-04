<?php
namespace Personal\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DBAL\Entity\Personal\Personal; //verificar porque deberia andar DBAL\Entity\Personal
use Personal\Form\PersonalForm;
use Zend\Mvc\MvcEvent;
use DBAL\Entity\User;
use DBAL\Entity\Company;

/**
 * El UserController contendrá la funcionalidad para el manejo de usuario (añadir, editar, cambio de 
 * contraseña, etc).
 */
class PersonalController extends AbstractActionController 
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
    private $personalManager;
    
    /**
     * Constructor. 
     */
    
    
    public function __construct($entityManager, $personalManager)
    {
        $this->entityManager = $entityManager;
        $this->personalManager = $personalManager;
    }
     
    /**
     * This is the default "index" action of the controller. It displays the 
     * list of users.
     */
    public function indexAction() 
    {
        
          //obtiene el contratista que esta registrado
        $contractorLog = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->identity());
        //la empresa del contratista
        $company = $contractorLog->getCompany();
        
        $personal = $this->entityManager->getRepository(Personal::class)
                ->findBy(['company'=>$company[0]]);
        
        return new ViewModel([
            'personal' => $personal
        ]);
    } 
    
    /**
     * This action displays a page allowing to add a new user.
     */



    public function addAction()
    {
        
         

        $form = new PersonalForm('create', $this->entityManager);
        // Check if user has submitted the form

        $contractorLog = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->identity());
        //la empresa del contratista
        $company = $contractorLog->getCompany();
        

        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            

            $form->setData($data);
            
            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                // Add user.
                $data['company'] = $company[0];
                $personal = $this->personalManager->addPersonal($data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('personal', 
                        ['action'=>'view', 'id'=>$personal->getId()]);                
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
        $personal = $this->entityManager->getRepository(Personal::class)
                ->find($id);
        
        if ($personal == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
                
        return new ViewModel([
            'personal' => $personal
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
        
        $personal = $this->entityManager->getRepository(Personal::class)
                ->find($id);
        
        if ($personal == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        // Create user form
        $form = new PersonalForm('update', $this->entityManager, $personal);
        
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
                $this->personalManager->updatePersonal($personal, $data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('personal', 
                        ['action'=>'view', 'id'=>$personal->getId()]);                
            }               
        } else {
            $form->setData(array(
                    'full_name'=>$personal->getFullName(),
                    'email'=>$personal->getEmail(),                    
                    'seniority'=>$personal->getSeniority(),                    
                ));
        }
        
        return new ViewModel(array(
            'personal' => $personal,
            'form' => $form
        ));
    }
    
    /**
     * This action displays a page allowing to change user's password.
     */
   
}


