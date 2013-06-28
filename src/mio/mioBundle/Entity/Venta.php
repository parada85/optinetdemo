<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Empleado;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/

class Venta extends Operacion
{
	/**
	* @ORM\Column(type="float",nullable=true)
	*/
	
	protected $total;

    /**
    * @ORM\Column(type="string")
    */
    
    protected $pago;

    /**
    * @ORM\Column(type="float")
    */
    
    protected $totalpago;
	
	  /**
     * @ORM\OneToMany(targetEntity="Devolucion", mappedBy="venta")
     */
	
	protected $devoluciones;
	
	 /**
     * @ORM\OneToOne(targetEntity="Reserva", mappedBy="venta")
     */
	
	protected $reserva;
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
        $this->devoluciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add devoluciones
     *
     * @param mio\mioBundle\Entity\Devolucion $devoluciones
     */
    public function addDevolucion(\mio\mioBundle\Entity\Devolucion $devoluciones)
    {
        $this->devoluciones[] = $devoluciones;
    }

    /**
     * Get devoluciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDevoluciones()
    {
        return $this->devoluciones;
    }

    /**
     * Set reserva
     *
     * @param mio\mioBundle\Entity\Reserva $reserva
     */
    public function setReserva(\mio\mioBundle\Entity\Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    /**
     * Get reserva
     *
     * @return mio\mioBundle\Entity\Reserva 
     */
    public function getReserva()
    {
        return $this->reserva;
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