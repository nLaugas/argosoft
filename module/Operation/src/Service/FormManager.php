<?php
namespace Operation\Service;

use DBAL\Entity\Form\General;


class FormManager
{
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
    public function addGeneral($data) 
    {
        
        
        // Create new General entity.
        $general = new General();
        $general->setDate($data['date']);
        $general->setCompany($data['company']);
        $general->setWorkPlace($data['workplace']);
        $general->setWorkStage($data['workstage']);
        $general->setWorkActivity($data['workactivity']);
        

        //preguntar si la carga el usuario o automaticamente puede cargarla 
        //$currentDate = date('Y-m-d H:i:s');
        
                
        // Add the entity to the entity manager.
        $this->entityManager->persist($general);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $general;
    }
    
    
}

