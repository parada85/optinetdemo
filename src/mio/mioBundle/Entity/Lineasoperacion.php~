<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
*/
class Lineasoperacion{
	
   /**
	* @ORM\Column(type="integer")
	*/
	 protected $cantidad;
	 
	 /**
	* @ORM\Column(type="float")
	*/
	 protected $precio;

     /**
    * @ORM\Column(type="float")
    */
     protected $pcompra;

    /**
    * @ORM\Column(type="integer")
    */
     protected $iva;

     /**
    * @ORM\Column(type="string",nullable=true)
    */
     protected $estado;
	
   /**
   * @ORM\Id
	* @ORM\ManyToOne(targetEntity="Producto",inversedBy="plineas")
	*/
	protected $producto;
	
	/**
   * @ORM\Id
	* @ORM\ManyToOne(targetEntity="Operacion",inversedBy="lineas")
	*/
	protected $operacion;

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set producto
     *
     * @param mio\mioBundle\Entity\Producto $producto
     */
    public function setProducto(\mio\mioBundle\Entity\Producto $producto)
    {
        $this->producto = $producto;
    }

    /**
     * Get producto
     *
     * @return mio\mioBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set operacion
     *
     * @param mio\mioBundle\Entity\Operacion $operacion
     */
    public function setOperacion(\mio\mioBundle\Entity\Operacion $operacion)
    {
        $this->operacion = $operacion;
    }

    /**
     * Get operacion
     *
     * @return mio\mioBundle\Entity\Operacion 
     */
    public function getOperacion()
    {
        return $this->operacion;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * Get precio
     *
     * @return integer 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set estado
     *
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set iva
     *
     * @param integer $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * Get iva
     *
     * @return integer 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set pcompra
     *
     * @param float $pcompra
     */
    public function setPcompra($pcompra)
    {
        $this->pcompra = $pcompra;
    }

    /**
     * Get pcompra
     *
     * @return float 
     */
    public function getPcompra()
    {
        return $this->pcompra;
    }
}