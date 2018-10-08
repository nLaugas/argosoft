<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Permit")
 */
class Permit 
{
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

     /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;

     /**
     * @ORM\Column(name="start_time")  
     */
    protected $startTime;

     /**
     * @ORM\Column(name="end_time")  
     */
    protected $endTime;
    /** 
     * @ORM\Column(name="work_reason")  
     */
    
    protected $workReason;
    
    

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

    public function getDataCreated()
    {
        return $this->dataCreated;
    }
    
    public function setDataCreated($dataCreated)
    {
        $this->dataCreated = $dataCreated;
        
    }

    public function getStartTime()
    {
        return $this->startTime;
    }
    
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        
    }

    public function getEndTime()
    {
        return $this->endTime;
    }
    
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        
    }

    public function getWorkReason()
    {
        return $this->workReason;
    }
    
    public function setWorkReason($workReason)
    {
        $this->workReason = $workReason;
        
    }
}



