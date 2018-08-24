<?php
namespace DBAL\Entity\Form;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This class represents a role.
 * @ORM\Entity()
 * @ORM\Table(name="general")
 */
class General
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="date")  
     */
    protected $date;
    
    /** 
     * @ORM\Column(name="company")  
     */
    protected $company;

    /** 
     * @ORM\Column(name="work_place")  
     */
    protected $workPlace;

    /** 
     * @ORM\Column(name="work_stage")  
     */
    protected $workStage;
    
    /** 
     * @ORM\Column(name="work_activity")  
     */
    protected $workActivity;


    public function __construct() 
    {
        
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        
    }

    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
        
    }

    public function getCompany()
    {
        return $this->company;
    }
    
    public function setCompany($company)
    {
        $this->company = $company;
        
    }

    public function getWorkPlace()
    {
        return $this->workPlace;
    }
    
    public function setWorkPlace($workPlace)
    {
        $this->workPlace = $workPlace;
        
    }
    public function getWorkStage()
    {
        return $this->workStage;
    }
    
    public function setWorkStage($workStage)
    {
        $this->workStage = $workStage;
        
    }

    public function getWorkActivity()
    {
        return $this->workActivity;
    }
    
    public function setWorkActivity($workActivity)
    {
        $this->workActivity = $workActivity;
        
    }

 }