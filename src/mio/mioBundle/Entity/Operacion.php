<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Lineasoperacion;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="mio\mioBundle\Entity\OperacionRepository")
* @ORM\InheritanceType("JOINED")
* @ORM\DiscriminatorColumn(name="tipo", type="string")
* @ORM\DiscriminatorMap({"venta" = "Venta", "reserva" = "Reserva", "devolucion" = "Devolucion","cita" = "Cita"})
*/
class Operacion{
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="IDENTITY")
	*/
	protected $id;
	
   /**
	* @ORM\Column(type="datetime")
	*/
	
	protected $fechaoper;
   
   /**
	* @ORM\ManyToOne(targetEntity="Usuario",inversedBy="operaciones")
	*/
	
	protected $cliente;
	
	/**
	* @ORM\ManyToOne(targetEntity="Empleado",inversedBy="operaciones")
	*/
	
	protected $empleado;
	
	/**
     * @ORM\OneToMany(targetEntity="Lineasoperacion", mappedBy="operacion")
     */
	
	protected $lineas;
    public function __construct()
    {
        $this->lineas = new \Doctrine\Common\Collections\ArrayCollection();
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