<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Medico;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/

class Cita  extends Operacion
{

    /**
    * @ORM\Column(type="datetime")
    */
    protected $fechacita;

    /**
    * @ORM\OneToOne(targetEntity="Informe", mappedBy="cita")
    */
    protected $informe;

    /**
     * @ORM\ManyToOne(targetEntity="Medico", inversedBy="citas")
    */
    protected $medico;
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
     * Set fechacita
     *
     * @param datetime $fechacita
     */
    public function setFechacita($fechacita)
    {
        $this->fechacita = $fechacita;
    }

    /**
     * Get fechacita
     *
     * @return datetime 
     */
    public function getFechacita()
    {
        return $this->fechacita;
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
     * Set informe
     *
     * @param mio\mioBundle\Entity\Informe $informe
     */
    public function setInforme(\mio\mioBundle\Entity\Informe $informe)
    {
        $this->informe = $informe;
    }

    /**
     * Get informe
     *
     * @return mio\mioBundle\Entity\Informe 
     */
    public function getInforme()
    {
        return $this->informe;
    }

    /**
     * Set medico
     *
     * @param mio\mioBundle\Entity\Medico $medico
     */
    public function setMedico(\mio\mioBundle\Entity\Medico $medico)
    {
        $this->medico = $medico;
    }

    /**
     * Get medico
     *
     * @return mio\mioBundle\Entity\Medico 
     */
    public function getMedico()
    {
        return $this->medico;
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