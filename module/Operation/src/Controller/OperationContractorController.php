<?php
namespace Operation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DBAL\Entity\Operation;
use DBAL\Entity\Tab;
use DBAL\Entity\General;
use DBAL\Entity\Company;
use DBAL\Entity\User;
use Operation\view;
use Zend\Mvc\MvcEvent;
use Operation\Form\CompanyForm;
use Operation\Form\PersonalForm;

class OperationContractorController extends AbstractActionController
{
    /**
     * @var DoctrineORMEntityManager
     */
    private $entityManager;

    private $formManager;
    private $contractorLog;
    
    public function __construct($entityManager, $formManager)
    {
        $this->entityManager = $entityManager;
        $this->formManager = $formManager;

    }
    
    
    
    public function indexAction()
    {
        
        if ($this->getRequest()->isPost()) 
        {
            $data = $this->params()->fromPost();
            
            $workPermit = $this->formManager->addNewWorkPermit($data);
            
            //print_r($data['protection']);
            //die(__FILE__);
            $this->redirect()->toRoute('modules');
        }
        
        //falta cargar los tab de cada persona 
        $tabs = $this->entityManager->getRepository(Tab::class)
                    ->findBy(array(),array('id' => 'ASC' )); //ordenado por id (puede que cambie por algun criterio)

        
        //levanta los archivo form/*.phtml de cada uno    
        foreach ($tabs as  $tab) 
        {
            $forms[$tab->getName()]= file_get_contents(__DIR__. '../../../view/operation/form/'.$tab->getName().'.phtml');
        }

        $view = new ViewModel(['tabs'=>$tabs,
                                'forms'=>$forms
        ]);

        return $view;
    }
   
   public function artAction()
    {
        
        $view = new ViewModel(['hola'=>'ART',
                                
        ]);

        return $view;
    }
   

   public function companyAction()
    {
        
         //obtiene el contratista que esta registrado
        $contractorLog = $this->entityManager->getRepository(User::class)
                    ->findOneByEmail($this->identity());
        //la empresa del contratista
        $company = $contractorLog->getCompany();
        
        
        $form = new CompanyForm();
        
        if($this->getRequest()->isPost())
        {
          // Fill in the form with POST data
          $data = $this->params()->fromPost();
          $form->setData($data);

          // Validate form
          if($form->isValid()) {

            // Get filtered and validated data
            $data = $form->getData();
            print_r($data);
            // ... Do something with the validated data ...

            // Redirect to "Thank You" page
            //return $this->redirect()->toRoute('application', ['action'=>'thankYou']);
          }
        }
        $view = new ViewModel(['form'=>$form,
                              'company' =>$company[0] 
                                
        ]);

        return $view;
    }

   public function personalAction()
    {
        $form = new PersonalForm();
        if($this->getRequest()->isPost())
        {
          // Fill in the form with POST data
          $data = $this->params()->fromPost();
          $form->setData($data);

          // Validate form
          if($form->isValid()) {

            // Get filtered and validated data
            $data = $form->getData();
            print_r($data);
            // ... Do something with the validated data ...

            // Redirect to "Thank You" page
            //return $this->redirect()->toRoute('application', ['action'=>'thankYou']);
          }
        }
        $view = new ViewModel(['form'=>$form,
                                
        ]);

        return $view;
    }
}
