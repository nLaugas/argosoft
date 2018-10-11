<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\User;
use DBAL\Entity\Module;
/**

  * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Perfil")

 */
class Profile
{
    const PROFILE_ADMIN = 'Admin';
    const PROFILE_CONTRACTOR = "Contratista";

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
     * @ORM\Column(name="description")  
     */
    protected $description;

    /**
     
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="profiles")
     */
  
    protected $users;
     
         /**
     *
     * @ORM\ManyToMany(targetEntity="Module", inversedBy="profiles")
     * @ORM\JoinTable(
     *  name="modulo_perfil",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_profile", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_module", referencedColumnName="id")
     *  }
     * )
     */

    protected $modules;

    public function __construct() 
    {
        $this->users = new ArrayCollection();
        $this->modules = new ArrayCollection();
    }
    
    /**
     * Returns role ID.
     * @return integer
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Sets role ID. 
     * @param int $id    
     */
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
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
    
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
  
    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        if ($this->users->contains($user)) {
            return;
        }
        $this->users->add($user);
        $user->addProfile($this);
    }
    /**
     * @param User $user
     */
    public function removeUser(User $user)
    {
        if (!$this->users->contains($user)) {
            return;
        }
        $this->users->removeElement($user);
        $user->removeProfile($this);
    }

    public function getModules()
    {
        return $this->modules;
    }
    
    public function setModules($modules)
    {
        $this->modules = $modules;
        
    }
 



   
}



