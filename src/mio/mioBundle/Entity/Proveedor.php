<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* @ORM\Entity(repositoryClass="mio\mioBundle\Entity\ProveedorRepository")
* @UniqueEntity("nombre")
*/
class Proveedor{
	
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="IDENTITY")
	*/
	public $id;
	
   /**
	* @ORM\Column(type="string",unique=true)
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
	*/
	
	 public $nombre;
	 
	  /**
	* @ORM\Column(type="string",nullable=true)
	*/
	
	 public $direccion;
	 
	  /**
	* @ORM\Column(type="string",length=9,nullable=true)
    * @Assert\MinLength(limit=9,message="El campo debe tener {{ limit }} números.")
    * @Assert\Type(type="numeric", message="El campo debe tener sólo números.")
	*/
	
	 public $telefono;
	 
	  /**
	* @ORM\Column(type="string",nullable=true)
    * @Assert\Regex(pattern="/^([A-z]+\s?)*$/",message="Este valor no es válido.")
	*/
	
	 public $localidad;
	 
	  /**
	* @ORM\Column(type="string",nullable=true)
    * @Assert\Regex(pattern="/^([A-z]+\s?)*$/",message="Este valor no es válido.")
	*/
	
	 public $provincia;
	 
	  /**
	* @ORM\Column(type="string",nullable=true)
    * @Assert\Email(
    * message = "El email {{ value }} no es un email válido.",
    * checkMX = true
    * )
	*/
	
	 public $email;
	
   /**
	* @ORM\OneToMany(targetEntity="Pedido",mappedBy="proveedor")
	*/
	
	protected $pedidos;
	
	/**
	* @ORM\OneToMany(targetEntity="Producto",mappedBy="proveedor")
	*/
	
	protected $productos;

    public function __construct()
    {
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
     * Get pedidos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }

    /**
     * Add pedidos
     *
     * @param mio\mioBundle\Entity\Pedido $pedidos
     */
    public function addPedido(\mio\mioBundle\Entity\Pedido $pedidos)
    {
        $this->pedidos[] = $pedidos;
    }

    /**
     * Add productos
     *
     * @param mio\mioBundle\Entity\Producto $productos
     */
    public function addProducto(\mio\mioBundle\Entity\Producto $productos)
    {
        $this->productos[] = $productos;
    }

    /**
     * Get productos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProductos()
    {
        return $this->productos;
    }
      
  	public function __toString()
	{
		return $this->getNombre();
	}
}