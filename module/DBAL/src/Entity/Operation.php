<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\Module;
/**
 * This class represents a role.
 * @ORM\Entity()
 * @ORM\Table(name="operacion")
 */
class Operation
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
     * @ORM\Column(name="route")  
     */
    protected $route;

  	/**
     
     *
     * @ORM\ManyToMany(targetEntity="Module", mappedBy="operations")
     */
  
    protected $modules;
	/**
     * Constructor.
     */
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

    public function getRoute()
    {
        return $this->route;
    }
    
    public function setRoute($route)
    {
        $this->route = $route;
        
    }
 }