<?php
namespace DBAL\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Id
     * @ORM\Column(name="idUsuario", type="integer")
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
    protected $password;
    
     
    private $perfiles;
    
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
    
    public function setPerfil(Perfil $perfil){
        $this->perfiles[] = $perfil;
    }

    public function getPerfiles(){
        return $this->perfiles;
    } 
    
}
