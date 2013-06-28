<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* @ORM\Entity(repositoryClass="mio\mioBundle\Entity\ProductoRepository")
* @UniqueEntity("descripcion")
*/

class Producto{
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="IDENTITY")
	*/
	protected $id;
	
   /**
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
	* @ORM\Column(type="string",unique=true)
	*/
	
	protected $descripcion;

   /**
	* @ORM\Column(type="integer")
	* @Assert\NotBlank(message="El campo no puede estar vacío.")
	* @Assert\Type(type="numeric", message="El campo debe tener sólo números.")
    * @Assert\Regex(pattern="/^[0-9]+$/",message="Este valor no es válido.")
	*/
	
	protected $stock;
	
	 /**
    * @ORM\Column(type="integer")
    */
    
    protected $reservado;

     /**
    * @ORM\Column(type="integer")
    */
    
    protected $apartado;
	
	/**
	* @ORM\Column(type="float")
    * @Assert\Type(type="numeric", message="El campo debe tener sólo números.")
	* @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^\d+(\.\d+)?$/",message="Este valor no es válido.")
	*/
	
	protected $pventa;
	
	 /**
	* @ORM\Column(type="float")
    * @Assert\Type(type="numeric", message="El campo debe tener sólo números.")
	* @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Regex(pattern="/^\d+(\.\d+)?$/",message="Este valor no es válido.")
	*/
	
	protected $pcompra;
	
	 /**
	* @ORM\Column(type="string")
	* @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @Assert\Type(type="numeric", message="El campo debe tener sólo números.")
	*/
	
	protected $iva;
	
   /**
	* @ORM\ManyToOne(targetEntity="Proveedor",inversedBy="productos")
    * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id", onDelete="SET NULL")
	*/
	
	protected $proveedor;
	
	 /**
    * @ORM\ManyToOne(targetEntity="Familia",inversedBy="productosfamilia")
    * @ORM\JoinColumn(name="familia_id", referencedColumnName="id", onDelete="SET NULL")
    */
    private $familia;
    
    /**
    * @ORM\OneToMany(targetEntity="Lineaspedido",mappedBy="producto")
    */
    protected $lineaspedido;
	
	/**
	* @ORM\OneToMany(targetEntity="Lineasoperacion",mappedBy="producto")
	*/
	protected $plineas;
    public function __construct()
    {
        $this->plineas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set stock
     *
     * @param string $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * Get stock
     *
     * @return string 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set pventa
     *
     * @param float $pventa
     */
    public function setPventa($pventa)
    {
        $this->pventa = $pventa;
    }

    /**
     * Get pventa
     *
     * @return float 
     */
    public function getPventa()
    {
        return $this->pventa;
    }

    /**
     * Set pcompra
     *
     * @param float $pcompra
     */
    public function setPcompra($pcompra)
    {
        $this->pcompra = $pcompra;
    }

    /**
     * Get pcompra
     *
     * @return float 
     */
    public function getPcompra()
    {
        return $this->pcompra;
    }

    /**
     * Set iva
     *
     * @param string $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * Get iva
     *
     * @return string 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set familia
     *
     * @param mio\mioBundle\Entity\Familia $familia
     */
    public function setFamilia($familia)
    {
        $this->familia = $familia;
    }

    /**
     * Get familia
     *
     * @return mio\mioBundle\Entity\Familia 
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Add plineas
     *
     * @param mio\mioBundle\Entity\Lineasoperacion $plineas
     */
    public function addLineasoperacion(\mio\mioBundle\Entity\Lineasoperacion $plineas)
    {
        $this->plineas[] = $plineas;
    }

    /**
     * Get plineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPlineas()
    {
        return $this->plineas;
    }

    /**
     * Add lineaspedido
     *
     * @param mio\mioBundle\Entity\Lineaspedido $lineaspedido
     */
    public function addLineaspedido(\mio\mioBundle\Entity\Lineaspedido $lineaspedido)
    {
        $this->lineaspedido[] = $lineaspedido;
    }

    /**
     * Get lineaspedido
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLineaspedido()
    {
        return $this->lineaspedido;
    }

    /**
     * Set proveedor
     *
     * @param mio\mioBundle\Entity\Proveedor $proveedor
     */
    public function setProveedor(\mio\mioBundle\Entity\Proveedor $proveedor)
    {
        $this->proveedor = $proveedor;
    }

    /**
     * Get proveedor
     *
     * @return mio\mioBundle\Entity\Proveedor 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set reservado
     *
     * @param integer $reservado
     */
    public function setReservado($reservado)
    {
        $this->reservado = $reservado;
    }

    /**
     * Get reservado
     *
     * @return integer 
     */
    public function getReservado()
    {
        return $this->reservado;
    }

    /**
     * Set apartado
     *
     * @param integer $apartado
     */
    public function setApartado($apartado)
    {
        $this->apartado = $apartado;
    }

    /**
     * Get apartado
     *
     * @return integer 
     */
    public function getApartado()
    {
        return $this->apartado;
    }
}