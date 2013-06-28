<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
*/
class Lineaspedido{
   
   /**
	* @ORM\Column(type="integer")
	*/
	
	 protected $cantidad;
	 
	/**
    * @ORM\Column(type="float")
    */
     protected $precio;

    /**
    * @ORM\Column(type="integer")
    */
     protected $iva;
	
   /**
   * @ORM\Id
	* @ORM\ManyToOne(targetEntity="Pedido",inversedBy="lineaspedido")
	*/
	
	protected $pedido;
	
   /**
   * @ORM\Id
	* @ORM\ManyToOne(targetEntity="Producto",inversedBy="lineaspedido")
	*/
	
	protected $producto;

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
     * Set precio
     *
     * @param float $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
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
     * Set pedido
     *
     * @param mio\mioBundle\Entity\Pedido $pedido
     */
    public function setPedido(\mio\mioBundle\Entity\Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Get pedido
     *
     * @return mio\mioBundle\Entity\Pedido 
     */
    public function getPedido()
    {
        return $this->pedido;
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
}