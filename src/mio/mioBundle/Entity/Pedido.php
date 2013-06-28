<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
*/
class Pedido{
	
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="IDENTITY")
	*/
	public $id;
	
   /**
	* @ORM\Column(type="datetime")
	*/
	
	 public $fecha;
	 
	  /**
	* @ORM\Column(type="datetime",nullable=true)
	*/
	
	 public $fecharecepcion;
	 
	/**
	* @ORM\Column(type="integer")
	*/
	
	 public $total;
	 
   /**
	* @ORM\ManyToOne(targetEntity="Proveedor",inversedBy="pedidos")
	*/
	
	protected $proveedor;
	
   /**
	* @ORM\ManyToOne(targetEntity="Empleado",inversedBy="pedidos")
	*/
	
	protected $empleado;
	
	/**
	* @ORM\ManyToOne(targetEntity="Empleado",inversedBy="recepciones")
	*/
	
	protected $recepciona;
	
   /**
	* @ORM\OneToMany(targetEntity="Lineaspedido",mappedBy="pedido")
	*/
	
	protected $lineaspedido;
    public function __construct()
    {
        $this->lineaspedido = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fecha
     *
     * @param datetime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fecharecepcion
     *
     * @param datetime $fecharecepcion
     */
    public function setFecharecepcion($fecharecepcion)
    {
        $this->fecharecepcion = $fecharecepcion;
    }

    /**
     * Get fecharecepcion
     *
     * @return datetime 
     */
    public function getFecharecepcion()
    {
        return $this->fecharecepcion;
    }

    /**
     * Set total
     *
     * @param integer $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
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
     * Set empleado
     *
     * @param mio\mioBundle\Entity\Empleado $empleado
     */
    public function setEmpleado(\mio\mioBundle\Entity\Empleado $empleado)
    {
        $this->empleado = $empleado;
    }

    /**
     * Get empleado
     *
     * @return mio\mioBundle\Entity\Empleado 
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set recepciona
     *
     * @param mio\mioBundle\Entity\Empleado $recepciona
     */
    public function setRecepciona(\mio\mioBundle\Entity\Empleado $recepciona)
    {
        $this->recepciona = $recepciona;
    }

    /**
     * Get recepciona
     *
     * @return mio\mioBundle\Entity\Empleado 
     */
    public function getRecepciona()
    {
        return $this->recepciona;
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
}