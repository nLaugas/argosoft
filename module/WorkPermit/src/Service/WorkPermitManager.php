<?php
namespace WorkPermit\Service;

use DBAL\Entity\WorkPermit\Permit;
use DBAL\Entity\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;
use DBAL\Entity\WorkPermit\SectionItem;
use DBAL\Entity\WorkPermit\PermitSectionItem;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class WorkPermitManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;  
    
    /**
     * Constructs the service.
     */
    public function __construct($entityManager) 
    {
        $this->entityManager = $entityManager;
    }


    /**
     * This method adds a new user.
     */
    public function addWorkPermit($data) 
    {
        
        
        

        $workPermit = new Permit();
        // $workPermit->setStartTime($data['start-time']);
        // $workPermit->setEndTime($data['end-time']);        
         $workPermit->setStartTime(date('H:i:s'));
         $workPermit->setEndTime(date('H:i:s'));        
         $workPermit->setWorkReason($data['work-reason']);        
         $workPermit->setPerformer($data['performer']);
        
        $contractorId = $data['contractor']; 
        $contractor = $this->entityManager->getRepository(User::class)
                    ->findOneById($contractorId);
        $workPermit->setContractor($contractor);
        $currentDate = date('Y-m-d H:i:s');
        $workPermit->setDateCreated($currentDate);        
                
        // Add the entity to the entity manager.
        $this->entityManager->persist($workPermit);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $workPermit;
    }
    
    /**
     * este metodo retorna todas las secciones con sus items. Y en que estado esta cada items (seleccionado o no seleccionado)
     */
    public function getSections($workPermit)
    {   
        $sections=[];
            
        $permitSectionItems = $this->entityManager->getRepository(PermitSectionItem::class)
         ->findBy(['permit'=>$workPermit]);
         
         foreach ($permitSectionItems as $permitSectionItem) {
             $sectionItem = $permitSectionItem->getSectionItem();
             $section = $sectionItem -> getSection();
             $item = $sectionItem-> getItem();
             $item->setSelect($permitSectionItem->getState());

             if (!in_array($section->getName(),$sections)){
                $sections[$section->getName()] = $section->getItems();
             }


         }
         
        return $sections;  
    }

   

    public function updateWorkPermit($workPermit, $data) 
    {
        
        $workPermit->setStartTime($data['start-time']);
        $workPermit->setEndTime($data['end-time']);        
        $workPermit->setWorkReason($data['work-reason']);               
        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }
      
    
    
}

