<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\Profile;
/**
 * This class represents a role.
 * @ORM\Entity()
 * @ORM\Table(name="modulo")
 */
class Module
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
     * @ORM\Column(name="template")  
     */
    protected $template;

   

    /**
     *
     * @ORM\ManyToMany(targetEntity="Profile", mappedBy="modules") 
    */
    protected $profiles;

    
    /**
     * Constructor.
     */
    public function __construct() 
    {
        
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        
    }

    public function getTemplate()
    {
        return $this->template;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
        
    }
}



