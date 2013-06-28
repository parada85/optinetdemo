<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="Arqueo")
* @ORM\Entity
*/
class Arqueo{
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="IDENTITY")
	*/

	public $id;
	
   /**
	* @ORM\Column(type="datetime")
	*/
	
	 public $fechaarqueo;
	 
	/**
    * @ORM\Column(type="float")
	*/
	
	 public $efectivo;

    /**
    * @ORM\Column(type="float")
    */
    
     public $efectivocont;
	 
	/**
	* @ORM\Column(type="integer")
	*/
	
	 public $boletas;

    /**
    * @ORM\Column(type="integer")
    */
    
     public $boletascont;

    /**
    * @ORM\Column(type="boolean")
    */
    
     public $estado;
	 
   /**
	* @ORM\ManyToOne(targetEntity="Empleado",inversedBy="arqueos")
	*/
	
	public $empleado;

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
     * Set fechaarqueo
     *
     * @param datetime $fechaarqueo
     */
    public function setFechaarqueo($fechaarqueo)
    {
        $this->fechaarqueo = $fechaarqueo;
    }

    /**
     * Get fechaarqueo
     *
     * @return datetime 
     */
    public function getFechaarqueo()
    {
        return $this->fechaarqueo;
    }

    /**
     * Set efectivo
     *
     * @param float $efectivo
     */
    public function setEfectivo($efectivo)
    {
        $this->efectivo = $efectivo;
    }

    /**
     * Get efectivo
     *
     * @return float 
     */
    public function getEfectivo()
    {
        return $this->efectivo;
    }

    /**
     * Set efectivocont
     *
     * @param float $efectivocont
     */
    public function setEfectivocont($efectivocont)
    {
        $this->efectivocont = $efectivocont;
    }

    /**
     * Get efectivocont
     *
     * @return float 
     */
    public function getEfectivocont()
    {
        return $this->efectivocont;
    }

    /**
     * Set boletas
     *
     * @param integer $boletas
     */
    public function setBoletas($boletas)
    {
        $this->boletas = $boletas;
    }

    /**
     * Get boletas
     *
     * @return integer 
     */
    public function getBoletas()
    {
        return $this->boletas;
    }

    /**
     * Set boletascont
     *
     * @param integer $boletascont
     */
    public function setBoletascont($boletascont)
    {
        $this->boletascont = $boletascont;
    }

    /**
     * Get boletascont
     *
     * @return integer 
     */
    public function getBoletascont()
    {
        return $this->boletascont;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
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
}