<?php
namespace WorkPermit\Service;

use DBAL\Entity\WorkPermit\Permit;
use DBAL\Entity\User;
use DBAL\Entity\Profile;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;
use DBAL\Entity\WorkPermit\SectionItem;
use DBAL\Entity\WorkPermit\PermitSectionItem;
use DBAL\Entity\WorkPermit\Section;
use DBAL\Entity\WorkPermit\PermitPersonal;
use DBAL\Entity\Personal\Personal;
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

    public function getAllContractors(){

        $allUsers  = $this->entityManager->getRepository(User::class)
                ->findAll();
        $contractorList = [];
        
        foreach ($allUsers as $user) {
            if ($user->isContractor())
                $contractorList[$user->getId()] = $user->getFullName();
        }
        return $contractorList;
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
        $contractor = $this->entityManager->getRepository(User::class)
                    ->findOneById($data['contractor']);
        $workPermit->setContractor($contractor);
        $workPermit->setDateCreated(new \DateTime());        
        $workPermit->setStatus(Permit::STATUS_ACTIVE); 
       

        //agregar las secciones dinamicas
         $this->setSectionToPermit(Permit::SECTION_1,$workPermit);
         $this->setSectionToPermit(Permit::SECTION_2,$workPermit);
         $this->setSectionToPermit(Permit::SECTION_3,$workPermit);

        $this->entityManager->persist($workPermit);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $workPermit;
    }

    private function setSectionToPermit($sectionName,$permit){
        $section = $this->entityManager->getRepository(Section::class)->findOneBy(['name'=>$sectionName]);
        $sectionItems = $this->entityManager->getRepository(SectionItem::class)->findBy(['section'=>$section]);
        
         foreach ($sectionItems as $key => $sectionItem) {
            $permitSectionItem = new PermitSectionItem();
            $permitSectionItem->setPermit($permit);
            $permitSectionItem->setSectionItem($sectionItem);
            $permitSectionItem->setState('D');
            $this->entityManager->persist($permitSectionItem);
            
         }
        // $permit->setSectionItem($sectionItem);
        // Apply changes to database.
        //$this->entityManager->flush();

            $this->entityManager->persist($permit);
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

    public function getPersonals($workPermit){
        $permitPersonals = $this->entityManager->getRepository(PermitPersonal::class)->findBy(['permit'=>$workPermit]);
        $personals = [];
        foreach ($permitPersonals as $key =>  $value) {
            $personals[$key] = $value->getPersonal();
        }
        return $personals; 
    }

    public function completeWorkPermit($workPermit, $data) 
    {


        $permitSectionItems = $this->entityManager->getRepository(PermitSectionItem::class)
         ->findBy(['permit'=>$workPermit]);

         foreach ($permitSectionItems as $permitSectionItem) {
             $sectionItem = $permitSectionItem->getSectionItem();
             $sectionName = $sectionItem->getSection()->getName();
             $itemName =  $sectionItem->getItem()->getName();
             //reemplaza los espacios por _ porque viene asi del form
             $sectionName_= str_replace(' ','_',$sectionName);
             if (($data[$sectionName_] != null) && in_array($itemName,$data[$sectionName_])){
                $permitSectionItem->setState(PermitSectionItem::SELECTED);
             }     
         }
        $personals = $this->getPersonals($workPermit);
        foreach ($data['personal'] as $personalId) {
            $personal = $this->entityManager->getRepository(Personal::class)->find($personalId);
            $permitPersonal = new PermitPersonal();
            if (!in_array($personal,$personals)) {
                $permitPersonal->setPermit($workPermit);
                $permitPersonal->setPersonal($personal);
                $this->entityManager->persist($permitPersonal);
            }
         }
        
        $workPermit->setStatus(Permit::STATUS_WAITING); 
        $this->entityManager->flush();

        return true;
    }
    
    
}

