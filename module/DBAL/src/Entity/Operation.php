<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\Module;
use DBAL\Entity\Tab;
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
     *
     * @ORM\ManyToMany(targetEntity="Tab", inversedBy="Operations")
     * @ORM\JoinTable(
     *  name="operation_tab",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_tab", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_operation", referencedColumnName="id")
     *  }
     * )
     */
    protected $tabs;
    /**
     * Constructor.
     */
    public function __construct() 
    {
        $this->tabs = new ArrayCollection(); 
    }

    public function getTabs()
    {
        return $this->Tabs;
    }
    
    public function setTabs($Tabs)
    {
        $this->Tabs = $Tabs;
        
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