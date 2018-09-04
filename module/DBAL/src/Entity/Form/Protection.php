<?php
namespace DBAL\Entity\Form;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This class represents a role.
 * @ORM\Entity()
 * @ORM\Table(name="protection")
 */
class Protection
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="date")  
     */
    protected $date;
    
    /** 
     * @ORM\Column(name="company")  
     */
    protected $company;

    /** 
     * @ORM\Column(name="work_place")  
     */
    protected $workPlace;

    /** 
     * @ORM\Column(name="work_stage")  
     */
    protected $workStage;
    
    /** 
     * @ORM\Column(name="work_activity")  
     */
    protected $workActivity;


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

    

 }