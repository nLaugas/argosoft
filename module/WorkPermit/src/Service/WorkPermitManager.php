<?php
namespace Personal\Service;

use DBAL\Entity\Personal\Personal;
use DBAL\Entity\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;



/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class PersonalManager
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
    public function addPersonal($data) 
    {
        // Do not allow several users with the same email address.
        if($this->checkPersonalExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }

        
        // Create new User entity.
        $personal = new Personal();
        $personal->setEmail($data['email']);
        $personal->setFullName($data['full_name']);        
        $personal->setSeniority($data['seniority']);        
        $personal->setCompany($data['company']);
        
        $currentDate = date('Y-m-d H:i:s');
        $personal->setDateCreated($currentDate);        
                
        // Add the entity to the entity manager.
        $this->entityManager->persist($personal);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $personal;
    }
    
    /**
     * This method updates data of an existing user.
     */
    public function updatePersonal($personal, $data) 
    {
        // Do not allow to change user email if another user with such email already exits.
        if($personal->getEmail()!=$data['email'] && $this->checkPersonalExists($data['email'])) {
            throw new \Exception("Another user with email address " . $data['email'] . " already exists");
        }
        
        $personal->setEmail($data['email']);
        $personal->setFullName($data['full_name']);               
        $personal->setSeniority($data['seniority']);               
        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }
    
   
    
  
    public function checkPersonalExists($email) {
        
        $personal = $this->entityManager->getRepository(Personal::class)
                ->findOneByEmail($email);
        
        return $personal !== null;
    }
    
    
    
    
   
    
    
    
}

