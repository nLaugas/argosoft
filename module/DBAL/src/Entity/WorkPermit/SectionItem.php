<?php
namespace DBAL\Entity\WorkPermit;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\WorkPermit\Permit;
/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Section_item")
 */
class SectionItem 
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

          /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\WorkPermit\Section")
   * @ORM\JoinColumn(name="section_id", referencedColumnName="id")
   */
    protected $section;

          /**
   * @ORM\ManyToOne(targetEntity="DBAL\Entity\WorkPermit\Item")
   * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
   */
    protected $item;
     
         /**
     *
     * @ORM\ManyToMany(targetEntity="Permit", inversedBy="sectionItems")
     * @ORM\JoinTable(
     *  name="permit_section_item",
     *  joinColumns={
     *      @ORM\JoinColumn(name="section_item_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="permit_id", referencedColumnName="id")
     *  }
     * )
     */

    protected $permits;

    public function __construct() 
    {
        $this->permits = new ArrayCollection();
        
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        
    }

    public function getSection()
    {
        return $this->section;
    }
    
    public function setSection($section)
    {
        $this->section = $section;
        
    }

    public function getItem()
    {
        return $this->item;
    }
    
    public function setItem($item)
    {
        $this->item = $item;
        
    }
    public function getPermits()
    {
        return $this->permits;
    }

    public function setPermits($permits)
    {
        $this->permits = $permits;
        
    }
}