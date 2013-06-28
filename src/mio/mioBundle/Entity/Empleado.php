<?php

namespace mio\mioBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="empleado")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="tipo1", type="string")
 * @ORM\DiscriminatorMap({"empleado" = "Empleado","medico" = "Medico"})
* @UniqueEntity(fields={"dni"}, message="Este valor ya se ha utilizado.")
* @UniqueEntity(fields={"email"}, message="Este valor ya se ha utilizado.")
* @UniqueEntity(fields={"username"}, message="Este valor ya se ha utilizado.")
 */
class Empleado implements AdvancedUserInterface, \Serializable
{
	
	/********************* metodos para el logueo de usuario *******************/
	function equals(\Symfony\Component\Security\Core\User\UserInterface $empleado)
	{
		return $this->getUsername() == $empleado->getUsername();
	}	

	function eraseCredentials()
	{
		//se deja en blanco
	}

	function getRoles()
	{
		return array("$this->role");
	}

	function getUsername()
	{
		return $this->username;
	}
	public function isAccountNonExpired()
    {
            return true;
    }

    public function isAccountNonLocked()
    {
            return true;
    }

    public function isCredentialsNonExpired()
    {
            return true;
    }

    public function isEnabled()
    {
        return $this->getActivo();
    }
	/***************************************************************************/
	
    public function serialize()
    {
       return serialize($this->getId());
    }
 
    public function unserialize($data)
    {
        $this->id = unserialize($data);
    } 
	
	/**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
    * @ORM\Column(type="string",length=9,unique=true)
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^\d{8}[A-z]$/",message="El dni es inválido.")
    */
	private $dni;

   /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^([A-z áéíóúÁÉÍÓÚÑñ]+\s?)*$/",message="Este valor no es válido.")
    */
    private $nombre;

    /**
     * @ORM\Column(name="idioma", length=7, type="string")
     */
    private $idioma;

    /**
     * @ORM\Column(name="tema",length=10, type="string")
     */
    private $tema;
    
    /**
     * @ORM\Column(name="username", type="string", unique=true)
     * @Assert\NotBlank(message="El campo no puede estar vacío.")
     */
    private $username;

    /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^([A-z áéíóúÁÉÍÓÚÑñ]+\s?)*$/",message="Este valor no es válido.")
    */
	
	private $apellido1;
	
		
      /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^([A-z áéíóúÁÉÍÓÚÑñ]+\s?)*$/",message="Este valor no es válido.")
    */
	
	private $apellido2;

    /**
    * @ORM\Column(name="email", type="string", unique=true)
	* @Assert\Email(
    * message = "El email:'{{ value }}' no es un email válido.",
    * checkMX = true
    * )
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    */
    private $email;
    
   /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^([A-z áéíóúÁÉÍÓÚÑñ]+\s?)*$/",message="Este valor no es válido.")
    */
	
	private $localidad;
	
   /**
    * @ORM\Column(type="string")
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^([A-z áéíóúÁÉÍÓÚÑñ]+\s?)*$/",message="Este valor no es válido.")
    */
	
	private $provincia;
    
    /**
    * @ORM\Column(type="string")
    */
    protected $claveusuario;

   /**
    * @Assert\MinLength(limit=9,message="El campo debe tener {{ limit }} números.")
    * @Assert\Type(type="numeric", message="El campo debe tener sólo números.")
    * @ORM\Column(type="string", length=9, nullable=true)
    */
	
	private $telefono;
	
   /**
    * @Assert\MinLength(limit=9,message="El campo debe tener {{ limit }} números.")
    * @Assert\Type(type="numeric", message="El campo debe tener sólo números.")
    * @ORM\Column(type="string", length=9, nullable=true)
    */	
	private $movil;

    /**
     * @ORM\Column(name="password", type="string", length=255)
	 * @Assert\MinLength(limit = 3, message = "La contraseña debe tener 3 caracteres")
     */
    private $password;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;
    
    /**
     * @ORM\Column(name="direccion", type="string")
	 * @Assert\MaxLength(limit = 140, message = "La direccion no puede pasar de 140 caracteres")
     * @Assert\NotBlank(message="El campo no puede estar vacío.")
     */
    private $direccion;

    /**
     * @ORM\Column(name="fechaalta", type="datetime")
     */
    private $fechaalta;
	
	/**
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Role", cascade={"persist"})
    */
    private $role;
    
    /**
	* @ORM\OneToMany(targetEntity="Pedido",mappedBy="recepciona")
	*/
	
	protected $recepciones;
	
	/**
	* @ORM\OneToMany(targetEntity="Pedido",mappedBy="empleado")
	*/
	
	protected $pedidos;

    /**
    * @ORM\OneToMany(targetEntity="Operacion",mappedBy="empleado")
    */
    
    protected $operaciones;

     /**
    * @ORM\OneToMany(targetEntity="Log",mappedBy="empleado")
    */
    
    protected $logs;

    /**
    * @ORM\OneToMany(targetEntity="Permiso",mappedBy="empleado")
    */
    
    protected $permisos;

    /**
    * @ORM\OneToMany(targetEntity="Modificacion",mappedBy="empleado")
    */
    
    protected $modificaciones;

    /**
    * @ORM\OneToMany(targetEntity="Arqueo",mappedBy="empleado")
    */
    
    protected $arqueos;

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

	public function __toString()
	{
		return $this->getNombre().' '.$this->getApellido1();
	}
	
	public function setRole(Role $role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function __construct()
    {
        $this->recepciones = new \Doctrine\Common\Collections\ArrayCollection();
    $this->pedidos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dni
     *
     * @param string $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set apellido1
     *
     * @param string $apellido1
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    }

    /**
     * Get apellido1
     *
     * @return string 
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
    }

    /**
     * Get apellido2
     *
     * @return string 
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set movil
     *
     * @param string $movil
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set fechaalta
     *
     * @param datetime $fechaalta
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;
    }

    /**
     * Get fechaalta
     *
     * @return datetime 
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Add recepciones
     *
     * @param mio\mioBundle\Entity\Pedido $recepciones
     */
    public function addPedido(\mio\mioBundle\Entity\Pedido $recepciones)
    {
        $this->recepciones[] = $recepciones;
    }

    /**
     * Get recepciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecepciones()
    {
        return $this->recepciones;
    }

    /**
     * Get pedidos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }

    /**
     * Add operaciones
     *
     * @param mio\mioBundle\Entity\Operacion $operaciones
     */
    public function addOperacion(\mio\mioBundle\Entity\Operacion $operaciones)
    {
        $this->operaciones[] = $operaciones;
    }

    /**
     * Get operaciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOperaciones()
    {
        return $this->operaciones;
    }

    /**
     * Set claveusuario
     *
     * @param string $claveusuario
     */
    public function setClaveusuario($claveusuario)
    {
        $this->claveusuario = $claveusuario;
    }

    /**
     * Get claveusuario
     *
     * @return string 
     */
    public function getClaveusuario()
    {
        return $this->claveusuario;
    }

    /**
     * Add logs
     *
     * @param mio\mioBundle\Entity\Log $logs
     */
    public function addLog(\mio\mioBundle\Entity\Log $logs)
    {
        $this->logs[] = $logs;
    }

    /**
     * Get logs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Add modificaciones
     *
     * @param mio\mioBundle\Entity\Modificacion $modificaciones
     */
    public function addModificacion(\mio\mioBundle\Entity\Modificacion $modificaciones)
    {
        $this->modificaciones[] = $modificaciones;
    }

    /**
     * Get modificaciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getModificaciones()
    {
        return $this->modificaciones;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    }

    /**
     * Get idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set tema
     *
     * @param string $tema
     */
    public function setTema($tema)
    {
        $this->tema = $tema;
    }

    /**
     * Get tema
     *
     * @return string 
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Add arqueo
     *
     * @param mio\mioBundle\Entity\Arqueo $arqueo
     */
    public function addArqueo(\mio\mioBundle\Entity\Arqueo $arqueo)
    {
        $this->arqueo[] = $arqueo;
    }

    /**
     * Get arqueo
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArqueo()
    {
        return $this->arqueo;
    }

    /**
     * Get arqueos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArqueos()
    {
        return $this->arqueos;
    }

    /**
     * Add permisos
     *
     * @param mio\mioBundle\Entity\Permiso $permisos
     */
    public function addPermiso(\mio\mioBundle\Entity\Permiso $permisos)
    {
        $this->permisos[] = $permisos;
    }

    /**
     * Get permisos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPermisos()
    {
        return $this->permisos;
    }
}