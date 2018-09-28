<?php
namespace DBAL\Entity\Personal;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\Company as Company;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Personal")
 */
class Personal 
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
     * @ORM\Column(name="full_name")  
     */
    protected $fullName;

    /**
     * @ORM\Column(name="seniority")  
     */
    protected $seniority;

    /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;
    
    /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\Company")
   * @ORM\JoinColumn(name="id_company", referencedColumnName="id")
   */
    protected $company;
    
     public function __construct() 
    {

    }


    /**
     * Returns user ID.
     * @return integer
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Sets user ID. 
     * @param int $id    
     */
    public function setId($id) 
    {
        $this->id = $id;
    }

   public function getCompany()
   {
       return $this->company;
   }
   
   public function setCompany($company)
   {
       $this->company = $company;
       
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
    public function getFullName() 
    {
        return $this->fullName;
    }       

    /**
     * Sets full name.
     * @param string $fullName
     */
    public function setFullName($fullName) 
    {
        $this->fullName = $fullName;
    }
    
    public function getSeniority()
    {
        return $this->seniority;
    }
    
    public function setSeniority($seniority)
    {
        $this->seniority = $seniority;
        
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



