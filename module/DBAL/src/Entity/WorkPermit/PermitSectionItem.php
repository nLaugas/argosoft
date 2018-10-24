<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\WorkPermit\SectionItem;
use DBAL\Entity\WorkPermit\Item;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="permit_section_item")
 */
class PermitSectionItem
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

     /**
     * @ORM\Column(name="state")  
     */
    protected $state;

    /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\WorkPermit\SectionItem")
   * @ORM\JoinColumn(name="section_item_id", referencedColumnName="id")
   */
    protected $sectionItem;

    /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\WorkPermit\Permit")
   * @ORM\JoinColumn(name="permit_id", referencedColumnName="id")
   */
    protected $permit;

     

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

    public function getState()
    {
       return $this->state;
    }

    public function setState($state)
    {
       $this->state = $state;
       
    }

    public function getPermit()
    {
        return $this->permit;
    }
    
    public function setPermit($permit)
    {
        $this->permit = $permit;
        
    }

    public function getSectionItem()
    {
        return $this->sectionItem;
    }
    
    public function setSectionItem($sectionItem)
    {
        $this->sectionItem = $sectionItem;
        
    }
}