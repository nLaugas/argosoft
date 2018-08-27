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
    private $em;

    private $formManager;
    
    public function __construct($entityManager, $formManager)
    {
        $this->em = $entityManager;
        $this->formManager = $formManager;
    }
    
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            // if ($this->formManager->addGeneral($data) != NULL)
            //     echo("agregado");
        $general = $this->formManager->addGeneral($data['general']);
        print_r($general);
            die(__FILE__);

        }
        //falta cargar los tab de cada persona 
        $tabs = $this->em->getRepository(Tab::class)
                    ->findBy(array(),array('id' => 'ASC' )); //ordenado por id (puede que cambie por algun criterio)

        //levanta los archivo form/*.phtml de cada uno    
        foreach ($tabs as  $tab) {
            $forms[$tab->getName()]= file_get_contents(__DIR__. '../../../view/operation/form/'.$tab->getName().'.phtml');
        }

        $view = new ViewModel(['tabs'=>$tabs,
                                'forms'=>$forms
        ]); 
        return $view;
    }

    public function coldAction()
    {
        
    }
}
