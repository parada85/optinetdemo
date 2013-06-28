<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Empleado;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/

class Log
{
	
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $fechalog;

    /**
    * @ORM\Column(type="string")
    */
    
    protected $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Empleado", inversedBy="logs")
    */
    protected $empleado;

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
     * Set fechalog
     *
     * @param datetime $fechalog
     */
    public function setFechalog($fechalog)
    {
        $this->fechalog = $fechalog;
    }

    /**
     * Get fechalog
     *
     * @return datetime 
     */
    public function getFechalog()
    {
        return $this->fechalog;
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
     * Set tipo
     *
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}