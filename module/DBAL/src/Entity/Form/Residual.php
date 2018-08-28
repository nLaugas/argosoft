<?php
namespace DBAL\Entity\Form;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * This class represents a role.
 * @ORM\Entity()
 * @ORM\Table(name="residual_permit")
 */
class Residual
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="team_pressure")  
     */
    protected $teamPressure;
    
    /** 
     * @ORM\Column(name="team_temperature")  
     */
    protected $teamTemperature;

    /** 
     * @ORM\Column(name="products")  
     */
    protected $products;

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

    public function getProducts()
    {
        return $this->products;
    }
    
    public function setProducts($products)
    {
        $this->products = $products;
        
    }
    public function getTeamPressure()
    {
        return $this->teamPressure;
    }
    
    public function setTeamPressure($teamPressure)
    {
        $this->teamPressure = $teamPressure;
    }

    public function getTeamTemperature()
    {
        return $this->teamTemperature;
    }
    
    public function setTeamTemperature($teamTemperature)
    {
        $this->teamTemperature = $teamTemperature;
        
    }

 }