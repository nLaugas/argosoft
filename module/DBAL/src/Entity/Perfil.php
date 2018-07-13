<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DBAL\Entity\Usuario as Usuario;
/**
 * Description of Usuario
 *
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="Perfil")
 */
class Perfil {
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
     * @ORM\Column(name="apellido", nullable=false, type="string", length=30)
     */
    protected $apellido;
    
      
   /**
     *
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="perfiles")
     * @ORM\JoinTable(name="Usuario_Perfil",
     *      joinColumns={@ORM\JoinColumn(name="idPerfil", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idUsuario", referencedColumnName="id")}
     *      )
     */
   
    protected $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    } 
    
    public function getNombre()
    {
        return $this->nombre;
    }     
    
    public function getApellido()
    {
        return $this->apellido;
    }
    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    /**
     * @param Usuario $usuario
     */
    public function addUsuario(Usuario $usuario)
    {
        if ($this->usuarios->contains($usuario)) {
            return;
        }
        $this->usuarios->add($usuario);
        $usuario->addPerfil($this);
    }
    /**
     * @param Usuario $usuario
     */
    public function removeUsuario(Usuario $usuario)
    {
        if (!$this->usuarios->contains($usuario)) {
            return;
        }
        $this->usuarios->removeElement($usuario);
        $usuario->removePerfil($this);
    }

}
