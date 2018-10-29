<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\WorkPermit\PermitPersonal;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="permit_personal")
 */
class PermitPersonal 
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

          /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\WorkPermit\Permit")
   * @ORM\JoinColumn(name="permit_id", referencedColumnName="id")
   */
    protected $permit;

          /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\Personal\Personal")
   * @ORM\JoinColumn(name="personal_id", referencedColumnName="id")
   */
    protected $personal;
     
    
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

    public function getPermit()
    {
        return $this->permit;
    }
    
    public function setPermit($permit)
    {
        $this->permit = $permit;
        
    }

    public function getPersonal()
    {
        return $this->personal;
    }
    
    public function setPersonal($personal)
    {
        $this->personal = $personal;
        
    }
    
}