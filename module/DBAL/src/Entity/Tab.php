<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This class represents a role.
 * @ORM\Entity()
 * @ORM\Table(name="tab")
 */
class Tab
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
     * @ORM\Column(name="icon")  
     */
    protected $icon;

    /**
     
     *
     * @ORM\ManyToMany(targetEntity="Operation", mappedBy="tags")
     */

    protected $operations;

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

    public function getIcon()
    {
        return $this->icon;
    }
    
    public function setIcon($icon)
    {
        $this->icon = $icon;
        
    }
 }