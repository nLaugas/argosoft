<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="ItemType")
 */
class ItemType 
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

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        
    }
}