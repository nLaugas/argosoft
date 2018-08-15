<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Operation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DBAL\Entity\Operation;
use DBAL\Entity\Tab;
use Operation\view;
class OperationController extends AbstractActionController
{
    /**
     * @var DoctrineORMEntityManager
     */
    protected $em;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
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
        $tabs = $this->em->getRepository(Tab::class)
                    ->findAll();

        var_dump(__DIR__);                
        $contenido = file_get_contents(__DIR__. '../../../view/operation/form/general.phtml');

        $view = new ViewModel(['tabs'=>$tabs,
                                'contenido'=>$contenido
        ]); 
        return $view;
    }

    public function coldAction()
    {
        
    }
}
