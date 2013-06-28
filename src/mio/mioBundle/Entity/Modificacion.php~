<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Empleado;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/

class Modificacion
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
    protected $fechamod;

    /**
    * @ORM\Column(type="string")
    */
    
    protected $entidad;

    /**
    * @ORM\Column(type="string")
    */

    protected $identificador;

    /**
    * @ORM\Column(type="string")
    */
    
    protected $tipo;

    /**
    * @ORM\Column(type="string")
    */
    
    protected $info;

    /**
     * @ORM\ManyToOne(targetEntity="Empleado", inversedBy="modificaciones")
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
     * Set fechamod
     *
     * @param datetime $fechamod
     */
    public function setFechamod($fechamod)
    {
        $this->fechamod = $fechamod;
    }

    /**
     * Get fechamod
     *
     * @return datetime 
     */
    public function getFechamod()
    {
        return $this->fechamod;
    }

    /**
     * Set entidad
     *
     * @param string $entidad
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;
    }

    /**
     * Get entidad
     *
     * @return string 
     */
    public function getEntidad()
    {
        return $this->entidad;
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

    /**
     * Set info
     *
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
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
     * Set identificador
     *
     * @param string $identificador
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;
    }

    /**
     * Get identificador
     *
     * @return string 
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }
}