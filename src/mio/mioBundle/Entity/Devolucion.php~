<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Operacion;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/

class Devolucion extends Operacion
{
	/**
	* @ORM\Column(type="float")
	*/
	
	protected $total;

	/**
	* @ORM\Column(type="string")
	*/
	
	protected $descripcion;
	
	/**
	* @ORM\ManyToOne(targetEntity="Venta",inversedBy="devoluciones")
	*/
	
	protected $venta;
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var datetime $fechaoper
     */
    protected $fechaoper;

    /**
     * @var mio\mioBundle\Entity\Usuario
     */
    protected $cliente;

    /**
     * @var mio\mioBundle\Entity\Empleado
     */
    protected $empleado;

    /**
     * @var mio\mioBundle\Entity\Lineasoperacion
     */
    protected $lineas;

    public function __construct()
    {
        $this->lineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set total
     *
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaoper
     *
     * @param datetime $fechaoper
     */
    public function setFechaoper($fechaoper)
    {
        $this->fechaoper = $fechaoper;
    }

    /**
     * Get fechaoper
     *
     * @return datetime 
     */
    public function getFechaoper()
    {
        return $this->fechaoper;
    }

    /**
     * Set venta
     *
     * @param mio\mioBundle\Entity\Venta $venta
     */
    public function setVenta(\mio\mioBundle\Entity\Venta $venta)
    {
        $this->venta = $venta;
    }

    /**
     * Get venta
     *
     * @return mio\mioBundle\Entity\Venta 
     */
    public function getVenta()
    {
        return $this->venta;
    }

    /**
     * Set cliente
     *
     * @param mio\mioBundle\Entity\Usuario $cliente
     */
    public function setCliente(\mio\mioBundle\Entity\Usuario $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Get cliente
     *
     * @return mio\mioBundle\Entity\Usuario 
     */
    public function getCliente()
    {
        return $this->cliente;
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
     * Add lineas
     *
     * @param mio\mioBundle\Entity\Lineasoperacion $lineas
     */
    public function addLineasoperacion(\mio\mioBundle\Entity\Lineasoperacion $lineas)
    {
        $this->lineas[] = $lineas;
    }

    /**
     * Get lineas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLineas()
    {
        return $this->lineas;
    }
}