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
        
        return new ViewModel(['hola'=>"hola"]);
    }

    public function coldAction()
    {
        
    }
}
