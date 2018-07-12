<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Id
     * @ORM\Column(name="idPerfil", type="integer")
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
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="perfiles")
     * @ORM\JoinTable(name="Usuario_Perfil",
     *      joinColumns={@JoinColumn(name="id_perfil", referencedColumnName="idPerfil")},
     *      inverseJoinColumns={@JoinColumn(name="id_usuario", referencedColumnName="idUsuario")}
     *      ))
    */ 
   

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
    
}
