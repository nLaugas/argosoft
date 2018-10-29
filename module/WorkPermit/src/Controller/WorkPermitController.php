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
class WorkPermitController extends WorkPermitContractorController 
{
    
    
    public function __construct($entityManager, $workPermitManager)
    {
       parent::__construct($entityManager, $workPermitManager);
       $this->profile = "performer";
    }
        

    public function addAction()
    {
        $form = new WorkPermitForm('create', $this->entityManager);
        $allContractors = $this->workPermitManager->getAllContractors();
        $form->get('contractor')->setValueOptions($allContractors);

        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            $form->setData($data);
            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                // usuario que crea el permiso.
                $data['performer'] = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->identity());
                $workPermit = $this->workPermitManager->addWorkPermit($data);
                
                // Redirect to "view" page
                return $this->redirect()->toRoute('workPermit', 
                        ['action'=>'index', 'id'=>$workPermit->getId()]);                
            }               
        } 
        
        return new ViewModel([
                'form' => $form
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

            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Update the user.
                $this->workPermitManager->updateWorkPermit($workPermit, $data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('workPermit', 
                        ['action'=>'index', 'id'=>$workPermit->getId()]);                
            }               
        } else {

            
            $form->setData(array(
                    'start-time'=>$workPermit->getStartTime(),
                    'end-time'=>$workPermit->getEndtime(),
                    'work-reason'=>$workPermit->getWorkReason(),
                ));
        }
        
        
        return new ViewModel(array(
            'workPermit' => $workPermit,
            'form' => $form,
        ));
    }
    

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
        
        $sections = $this->workPermitManager->getSections($workPermit);
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data

            $data = $this->params()->fromPost();     
            if ($data['validar'] == "acepted"){
                $workPermit->setStatus(Permit::STATUS_FINALIZED);
                 $this->entityManager->persist($workPermit);    
            }       
            else
            {
                $workPermit->setStatus(Permit::STATUS_ACTIVE);
                 $this->entityManager->persist($workPermit);    
            }
            // Apply changes to database.
            $this->entityManager->flush();
            return $this->redirect()->toRoute('workPermit');


            
        }
        
        
        return new ViewModel(array(
            'workPermit' => $workPermit,
            'sections' => $sections,
        ));
    }
    /**
     * This action displays a page allowing to change user's password.
     */
   
}


