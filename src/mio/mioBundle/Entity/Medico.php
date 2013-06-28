<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Cita;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="medico")
 * @UniqueEntity(fields={"color"}, message="Este valor ya se ha utilizado.")
 */

class Medico extends Empleado
{
	/**
    * @ORM\Column(type="string",nullable=true)
	*/
	
	protected $titulacion;
	
    /**
    * @ORM\Column(type="string",nullable=true)
    */
    
    protected $numero;

    /**
    * @Assert\NotBlank(message="El campo no puede estar vacío.")
    * @ORM\Column(type="string",unique=true)
    */
    
    protected $color;

    /**
    * @ORM\OneToMany(targetEntity="Cita", mappedBy="medico")
    */
    protected $citas;
    /**
     * @var string $claveusuario
     */
    protected $claveusuario;

    /**
     * @var mio\mioBundle\Entity\Pedido
     */
    protected $recepciones;

    /**
     * @var mio\mioBundle\Entity\Pedido
     */
    protected $pedidos;

    /**
     * @var mio\mioBundle\Entity\Operacion
     */
    protected $operaciones;

    /**
     * @var mio\mioBundle\Entity\Log
     */
    protected $logs;

    /**
     * @var mio\mioBundle\Entity\Modificacion
     */
    protected $modificaciones;

    public function __construct()
    {
        $this->citas = new \Doctrine\Common\Collections\ArrayCollection();
    $this->recepciones = new \Doctrine\Common\Collections\ArrayCollection();
    $this->pedidos = new \Doctrine\Common\Collections\ArrayCollection();
    $this->operaciones = new \Doctrine\Common\Collections\ArrayCollection();
    $this->logs = new \Doctrine\Common\Collections\ArrayCollection();
    $this->modificaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set titulacion
     *
     * @param string $titulacion
     */
    public function setTitulacion($titulacion)
    {
        $this->titulacion = $titulacion;
    }

    /**
     * Get titulacion
     *
     * @return string 
     */
    public function getTitulacion()
    {
        return $this->titulacion;
    }

    /**
     * Set numero
     *
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set claveusuario
     *
     * @param string $claveusuario
     */
    public function setClaveusuario($claveusuario)
    {
        $this->claveusuario = $claveusuario;
    }

    /**
     * Get claveusuario
     *
     * @return string 
     */
    public function getClaveusuario()
    {
        return $this->claveusuario;
    }

    /**
     * Add citas
     *
     * @param mio\mioBundle\Entity\Cita $citas
     */
    public function addCita(\mio\mioBundle\Entity\Cita $citas)
    {
        $this->citas[] = $citas;
    }

    /**
     * Get citas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCitas()
    {
        return $this->citas;
    }

    /**
     * Add recepciones
     *
     * @param mio\mioBundle\Entity\Pedido $recepciones
     */
    public function addPedido(\mio\mioBundle\Entity\Pedido $recepciones)
    {
        $this->recepciones[] = $recepciones;
    }

    /**
     * Get recepciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecepciones()
    {
        return $this->recepciones;
    }

    /**
     * Get pedidos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPedidos()
    {
        return $this->pedidos;
    }

    /**
     * Add operaciones
     *
     * @param mio\mioBundle\Entity\Operacion $operaciones
     */
    public function addOperacion(\mio\mioBundle\Entity\Operacion $operaciones)
    {
        $this->operaciones[] = $operaciones;
    }

    /**
     * Get operaciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOperaciones()
    {
        return $this->operaciones;
    }

    /**
     * Add logs
     *
     * @param mio\mioBundle\Entity\Log $logs
     */
    public function addLog(\mio\mioBundle\Entity\Log $logs)
    {
        $this->logs[] = $logs;
    }

    /**
     * Get logs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Add modificaciones
     *
     * @param mio\mioBundle\Entity\Modificacion $modificaciones
     */
    public function addModificacion(\mio\mioBundle\Entity\Modificacion $modificaciones)
    {
        $this->modificaciones[] = $modificaciones;
    }

    /**
     * Get modificaciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getModificaciones()
    {
        return $this->modificaciones;
    }
    /**
     * @var mio\mioBundle\Entity\Arqueo
     */
    protected $arqueos;

    /**
     * Add arqueos
     *
     * @param mio\mioBundle\Entity\Arqueo $arqueos
     */
    public function addArqueo(\mio\mioBundle\Entity\Arqueo $arqueos)
    {
        $this->arqueos[] = $arqueos;
    }

    /**
     * Get arqueos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArqueos()
    {
        return $this->arqueos;
    }

    /**
     * Set color
     *
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }
    /**
     * @var mio\mioBundle\Entity\Permiso
     */
    protected $permisos;


    /**
     * Add permisos
     *
     * @param mio\mioBundle\Entity\Permiso $permisos
     */
    public function addPermiso(\mio\mioBundle\Entity\Permiso $permisos)
    {
        $this->permisos[] = $permisos;
    }

    /**
     * Get permisos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPermisos()
    {
        return $this->permisos;
    }
}