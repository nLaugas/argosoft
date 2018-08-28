<?php
namespace Operation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DBAL\Entity\Operation;
use DBAL\Entity\Tab;
use DBAL\Entity\General;
use Operation\view;

class OperationController extends AbstractActionController
{
    /**
     * @var DoctrineORMEntityManager
     */
    private $entityManager;

    private $formManager;
    
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
            // if ($this->formManager->addGeneral($data) != NULL)
            //     echo("agregado");
            
            $workPermit = $this->formManager->addNewWorkPermit($data);
            
            //print_r($data);
            die(__FILE__);

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
    public function checkWorkPermitsAction()
    {
        
        //print_r($this->entityManager->getRepository(General::class)->findOneBy( array('id'=>1)));
        

        echo "<h2>checkWorkPermitsAction</h2>";
        return "hola";
    }
   



    public function coldAction()
    {
        
    }
}
