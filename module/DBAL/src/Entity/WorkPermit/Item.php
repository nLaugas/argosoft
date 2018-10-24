<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\WorkPermit\ItemType;
use DBAL\Entity\WorkPermit\Section;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Item")
 */
class Item 
{   
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

     /**
     * @ORM\Column(name="name")  
     */
    protected $name;

     /**
     * @ORM\Column(name="details")  
     */
    protected $details;

    /**
     
     *
     * @ORM\ManyToMany(targetEntity="Section", mappedBy="items")
     */
  
    protected $sections;

    /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\WorkPermit\ItemType")
   * @ORM\JoinColumn(name="itemtype_id", referencedColumnName="id")
   */
    protected $type;

    protected $select;

    public function __construct() 
    {
        
        $this->sections = new ArrayCollection();
        $this->select = false;
        
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        
    }

    public function getDetails()
    {
        return $this->details;
    }
    
    public function setDetails($details)
    {
        $this->details = $details;
        
    }

    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        
    }
    
    public function getSections()
    {
        return $this->sections;
    }
    
    public function setSections($sections)
    {
        $this->sections = $sections;
        
    }
    public function getSelect()
    {
        return $this->select;
    }
    
    public function setSelect($select)
    {
        $this->select = $select;
        
    }
}



