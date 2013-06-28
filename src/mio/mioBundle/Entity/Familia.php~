<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Producto;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity("nombre")
 */

class Familia{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(length=50,unique=true)
     * @Assert\NotBlank(message="El campo no puede estar vacío.")
     */
    protected $nombre;
    
    /**
    * @ORM\OneToMany(targetEntity="Producto",mappedBy="familia")
    */
    protected $productosfamilia;
    public function __construct()
    {
        $this->productosfamilia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add productosfamilia
     *
     * @param mio\mioBundle\Entity\Producto $productosfamilia
     */
    public function addProducto(\mio\mioBundle\Entity\Producto $productosfamilia)
    {
        $this->productosfamilia[] = $productosfamilia;
    }

    /**
     * Get productosfamilia
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProductosfamilia()
    {
        return $this->productosfamilia;
    }
 	public function __toString()
	{
		return $this->getNombre();
	}
}