<?php
namespace DBAL\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\User;
use DBAL\Entity\Personal;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Company")
 */
class Company 
{
   
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="email")  
     */
    protected $email;
    
    /** 
     * @ORM\Column(name="name")  
     */
    protected $name;

    /** 
     * @ORM\Column(name="address")  
     */
    protected $address;
    /**
     * @ORM\Column(name="cuit")  
     */
    protected $cuit;

    /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;
    

     /**
   * @ORM\ManyToOne(targetEntity="User", inversedBy="company")
   * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
   */
    protected $contractor; 


    public function __construct() 
    {
        
    }
    

    public function getContractor()
    {
        return $this->contractor;
    }
    
    public function setContractor($contractor)
    {
        $this->contractor = $contractor;
        
    }
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Sets user ID. 
     * @param int $id    
     */
    public function getCuit()
    {
        return $this->cuit;
    }
    
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;
        
    }
    public function setId($id) 
    {
        $this->id = $id;
    }

    /**
     * Returns email.     
     * @return string
     */
    public function getEmail() 
    {
        return $this->email;
    }

    /**
     * Sets email.     
     * @param string $email
     */
    public function setEmail($email) 
    {
        $this->email = $email;
    }
    
    /**
     * Returns full name.
     * @return string     
     */
    public function getName() 
    {
        return $this->name;
    }       

    /**
     * Sets full name.
     * @param string $fullName
     */
    public function setName($name) 
    {
        $this->name = $name;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
        
    }
    /**
     * Returns the date of user creation.
     * @return string     
     */
    public function getDateCreated() 
    {
        return $this->dateCreated;
    }
    
    /**
     * Sets the date when this user was created.
     * @param string $dateCreated     
     */
    public function setDateCreated($dateCreated) 
    {
        $this->dateCreated = $dateCreated;
    }    
    
    

}



