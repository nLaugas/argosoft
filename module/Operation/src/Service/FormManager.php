<?php
namespace Operation\Service;

use DBAL\Entity\Form\General;
use DBAL\Entity\Form\Residual;

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
     * This method adds a new work permits.
     */
    public function addNewWorkPermit($data) 
    {
        
        
        //parse subforms

        $dataGeneral = $data['general'];
        $dataResidual = $data['residual'];
        $enviromental = $data['enviromental'];
        $protection = $data['protection'];



        // Create new General entity

        $general = new General();
        $general->setDate($dataGeneral['date']); //preguntar si la fecha carga auto
        $general->setCompany($dataGeneral['company']);
        $general->setWorkPlace($dataGeneral['workplace']);
        $general->setWorkStage($dataGeneral['workstage']);
        $general->setWorkActivity($dataGeneral['workactivity']);
        

        
        // Create new Residual entity.
        
        $residual = new Residual();  
        $residual->setTeamTemperature($dataResidual['teamTemperature']);
        $residual->setTeamPressure($dataResidual['teamPressure']);
        $residual->setProducts($dataResidual['product']);

        // Create new Protection entity.
        //$protection = new Protection();

        // Create new Protection entity.
        //$enviromental = new Enviromental();


        // Add the entities to the entity manager.

        $this->entityManager->persist($general);
        $this->entityManager->persist($residual);
        //$this->entityManager->persist($protection);
        //$this->entityManager->persist($enviromental);
        
        
        // Apply changes to database.
        
        $this->entityManager->flush();
        
        return true;
    }
    
    
}

