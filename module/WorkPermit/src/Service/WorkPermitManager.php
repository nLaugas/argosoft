<?php
namespace WorkPermit\Service;

use DBAL\Entity\WorkPermit\Permit;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;



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
        
        // Create new User entity.
        $workPermit = new WorkPermit();
        $workPermit->setStartTime($data['start-time']);
        $workPermit->setEndTime($data['end-time']);        
        $workPermit->setWorkReason($data['work-reason']);        
        
    
        $currentDate = date('Y-m-d H:i:s');
        $workPermit->setDateCreated($currentDate);        
                
        // Add the entity to the entity manager.
        $this->entityManager->persist($workPermit);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $workPermit;
    }
    
    /**
     * This method updates data of an existing user.
     */
    public function updatePersonal($workPermit, $data) 
    {
        
        $workPermit->setStartTime($data['start-time']);
        $workPermit->setEndTime($data['end-time']);        
        $workPermit->setWorkReason($data['work-reason']);               
        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }
      
    
    
}

