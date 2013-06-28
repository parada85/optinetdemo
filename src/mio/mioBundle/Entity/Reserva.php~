<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Operacion;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/

class Reserva extends Operacion
{

    /**
    * @ORM\Column(type="string")
    */
    
    protected $pago;

    /**
    * @ORM\Column(type="float")
    */
    
    protected $totalpago;

	/**
    * @ORM\Column(type="datetime",nullable=true)
    */
	
	protected $avisada;

   /**
	* @ORM\Column(type="integer")
	*/
	
	protected $adelanto;
	
	/**
	* @ORM\Column(type="float")
	*/
	
	protected $total;

    /**
    * @ORM\Column(type="string")
    */
    
    protected $apartado;
	
	/**
	* @ORM\OneToOne(targetEntity="Venta",inversedBy="reserva")
	*/
	
	protected $venta;
	
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var date $fechaoper
     */
    protected $fechaoper;

    /**
     * @var mio\mioBundle\Entity\Usuario
     */
    protected $cliente;

    /**
     * @var mio\mioBundle\Entity\Lineasoperacion
     */
    protected $lineas;

    public function __construct()
    {
        $this->lineas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set avisada
     *
     * @param boolean $avisada
     */
    public function setAvisada($avisada)
    {
        $this->avisada = $avisada;
    }

    /**
     * Get avisada
     *
     * @return boolean 
     */
    public function getAvisada()
    {
        return $this->avisada;
    }

    /**
     * Set adelanto
     *
     * @param integer $adelanto
     */
    public function setAdelanto($adelanto)
    {
        $this->adelanto = $adelanto;
    }

    /**
     * Get adelanto
     *
     * @return integer 
     */
    public function getAdelanto()
    {
        return $this->adelanto;
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
     * @param date $fechaoper
     */
    public function setFechaoper($fechaoper)
    {
        $this->fechaoper = $fechaoper;
    }

    /**
     * Get fechaoper
     *
     * @return date 
     */
    public function getFechaoper()
    {
        return $this->fechaoper;
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
    /**
     * @var mio\mioBundle\Entity\Empleado
     */
    protected $empleado;


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
     * Set pago
     *
     * @param string $pago
     */
    public function setPago($pago)
    {
        $this->pago = $pago;
    }

    /**
     * Get pago
     *
     * @return string 
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set apartado
     *
     * @param string $apartado
     */
    public function setApartado($apartado)
    {
        $this->apartado = $apartado;
    }

    /**
     * Get apartado
     *
     * @return string 
     */
    public function getApartado()
    {
        return $this->apartado;
    }

    /**
     * Set totalpago
     *
     * @param float $totalpago
     */
    public function setTotalpago($totalpago)
    {
        $this->totalpago = $totalpago;
    }

    /**
     * Get totalpago
     *
     * @return float 
     */
    public function getTotalpago()
    {
        return $this->totalpago;
    }
}