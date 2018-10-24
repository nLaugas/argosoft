<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\WorkPermit\Item;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Section")
 */
class Section 
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
     *
     * @ORM\ManyToMany(targetEntity="Item", inversedBy="sections")
     * @ORM\JoinTable(
     *  name="section_item",
     *  joinColumns={
     *      @ORM\JoinColumn(name="section_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $items;


    public function __construct() 
    {
        $this->items = new ArrayCollection();
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
    public function getItems()
    {
        return $this->items;
    }
    
    public function setItems($items)
    {
        $this->items = $items;
        
    }
}