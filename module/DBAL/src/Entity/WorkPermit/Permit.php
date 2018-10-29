<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\WorkPermit\SectionItem;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Permit")
 */
class Permit 
{
    // Permit status constants.
    const STATUS_ACTIVE       = 'a'; 
    const STATUS_FINALIZED      = 'f'; 
    const STATUS_WAITING      = 'w';
    const SECTION_1 = "Revisión de Equipos y Herramientas";
    const SECTION_2 = "Peligros y Riesgos Potenciales";
    const SECTION_3 = "Elementos de Protección";
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

     /**
     * @ORM\Column(name="date_created",type="date")  
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

    /** 
     * @ORM\Column(name="status")  
     */
    
    protected $status;
    
      /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\User")
   * @ORM\JoinColumn(name="performer_id", referencedColumnName="id")
   */
    protected $performer;


    /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\User")
   * @ORM\JoinColumn(name="contractor_id", referencedColumnName="id")
   */
    protected $contractor;

    /**
     *
     * @ORM\ManyToMany(targetEntity="SectionItem", mappedBy="permits")
     */
  
    protected $sectionItems;

    public function __construct() 
    {
        
        $this->sectionItems = new ArrayCollection();
    }
    public function getContractor()
    {
        return $this->contractor;
    }
    
    public function setContractor($contractor)
    {
        $this->contractor = $contractor;
        
    }
    public function getPerformer()
    {
        return $this->performer;
    }
    
    public function setPerformer($performer)
    {
        $this->performer = $performer;
        
    }
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }
    
    public function setDateCreated($dataCreated)
    {
        $this->dateCreated = $dataCreated;
        
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
    public function getSectionItems()
    {
        return $this->sectionItems;
    }
    
    public function setSectionItems($sectionItems)
    {
        $this->sectionItems = $sectionItems;
        
    }

    public function setSectionItem($sectionItem){
        $this->sectionItems->add($sectionItem);
    }

    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
        
    }
}



