<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
use DBAL\Entity\Perfil as Perfil;
use DBAL\Entity\Usuario as Usuario;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Description of Usuario
 *
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Usuario")
 */
class Usuario {
    //put your code here
    
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="nombre", nullable=false, type="string", length=30)
     */
    protected $nombre;
    
    /**
     * @ORM\Column(name="clave", nullable=false, type="string", length=30)
     */
    protected $clave;

        /**
     * @ORM\ManyToMany(targetEntity="Perfil", inversedBy="usuarios")
     * @ORM\JoinTable(name="Usuario_Perfil",
     *      joinColumns={@ORM\JoinColumn(name="idUsuario", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idPerfil", referencedColumnName="id")}
     *      )
     */
    public $perfiles;
    
    public function __construct() {
        $this->perfiles = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    } 
    
    public function getNombre()
    {
        return $this->nombre;
    }     
    
    public function getClave()
    {
        return $this->password;
    }
    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getPerfiles(){
        return $this->perfiles;
    } 
     /**
     * @param Perfil $perfil
     */
    public function addPerfil(Perfil $perfil)
    {
        if ($this->perfiles->contains($perfil)) {
            return;
        }
        $this->perfiles->add($perfil);
        $perfil->addUsuario($this);
    }
    /**
     * @param Perfil $perfil
     */
    public function removePerfil(Perfil $perfil)
    {
        if (!$this->perfiles->contains($perfil)) {
            return;
        }
        $this->perfiles->removeElement($perfil);
        $perfil->removeUsuario($this);
    }

}
