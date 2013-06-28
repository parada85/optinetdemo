<?php

namespace mio\mioBundle\Entity;

use mio\mioBundle\Entity\Cita;
use mio\mioBundle\Entity\Medico;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/

class Informe
{

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    protected $id;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $fecha;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $odavsc;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $odavcc;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $odesf;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $odcil;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $odeje;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $odav;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $oiavsc;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $oiavcc;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $oiesf;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $oicil;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $oieje;

    /**
    * @ORM\Column(type="string",nullable=true)
    */
    protected $oiav;

    /**
    * @ORM\Column(type="string")
    */
    protected $problema;

    /**
    * @ORM\Column(type="string")
    */
    protected $pupilar;
    
    /**
    * @ORM\Column(type="string")
    */
    protected $worth;
    
    /**
    * @ORM\Column(type="string")
    */
    protected $Amsler;

    /**
    * @ORM\OneToOne(targetEntity="Cita", inversedBy="informe")
    */
    protected $cita;

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
     * Set fecha
     *
     * @param datetime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set odavsc
     *
     * @param string $odavsc
     */
    public function setOdavsc($odavsc)
    {
        $this->odavsc = $odavsc;
    }

    /**
     * Get odavsc
     *
     * @return string 
     */
    public function getOdavsc()
    {
        return $this->odavsc;
    }

    /**
     * Set odavcc
     *
     * @param string $odavcc
     */
    public function setOdavcc($odavcc)
    {
        $this->odavcc = $odavcc;
    }

    /**
     * Get odavcc
     *
     * @return string 
     */
    public function getOdavcc()
    {
        return $this->odavcc;
    }

    /**
     * Set odesf
     *
     * @param string $odesf
     */
    public function setOdesf($odesf)
    {
        $this->odesf = $odesf;
    }

    /**
     * Get odesf
     *
     * @return string 
     */
    public function getOdesf()
    {
        return $this->odesf;
    }

    /**
     * Set odcil
     *
     * @param string $odcil
     */
    public function setOdcil($odcil)
    {
        $this->odcil = $odcil;
    }

    /**
     * Get odcil
     *
     * @return string 
     */
    public function getOdcil()
    {
        return $this->odcil;
    }

    /**
     * Set odeje
     *
     * @param string $odeje
     */
    public function setOdeje($odeje)
    {
        $this->odeje = $odeje;
    }

    /**
     * Get odeje
     *
     * @return string 
     */
    public function getOdeje()
    {
        return $this->odeje;
    }

    /**
     * Set odav
     *
     * @param string $odav
     */
    public function setOdav($odav)
    {
        $this->odav = $odav;
    }

    /**
     * Get odav
     *
     * @return string 
     */
    public function getOdav()
    {
        return $this->odav;
    }

    /**
     * Set oiavsc
     *
     * @param string $oiavsc
     */
    public function setOiavsc($oiavsc)
    {
        $this->oiavsc = $oiavsc;
    }

    /**
     * Get oiavsc
     *
     * @return string 
     */
    public function getOiavsc()
    {
        return $this->oiavsc;
    }

    /**
     * Set oiavcc
     *
     * @param string $oiavcc
     */
    public function setOiavcc($oiavcc)
    {
        $this->oiavcc = $oiavcc;
    }

    /**
     * Get oiavcc
     *
     * @return string 
     */
    public function getOiavcc()
    {
        return $this->oiavcc;
    }

    /**
     * Set oiesf
     *
     * @param string $oiesf
     */
    public function setOiesf($oiesf)
    {
        $this->oiesf = $oiesf;
    }

    /**
     * Get oiesf
     *
     * @return string 
     */
    public function getOiesf()
    {
        return $this->oiesf;
    }

    /**
     * Set oicil
     *
     * @param string $oicil
     */
    public function setOicil($oicil)
    {
        $this->oicil = $oicil;
    }

    /**
     * Get oicil
     *
     * @return string 
     */
    public function getOicil()
    {
        return $this->oicil;
    }

    /**
     * Set oieje
     *
     * @param string $oieje
     */
    public function setOieje($oieje)
    {
        $this->oieje = $oieje;
    }

    /**
     * Get oieje
     *
     * @return string 
     */
    public function getOieje()
    {
        return $this->oieje;
    }

    /**
     * Set oiav
     *
     * @param string $oiav
     */
    public function setOiav($oiav)
    {
        $this->oiav = $oiav;
    }

    /**
     * Get oiav
     *
     * @return string 
     */
    public function getOiav()
    {
        return $this->oiav;
    }

    /**
     * Set problema
     *
     * @param string $problema
     */
    public function setProblema($problema)
    {
        $this->problema = $problema;
    }

    /**
     * Get problema
     *
     * @return string 
     */
    public function getProblema()
    {
        return $this->problema;
    }

    /**
     * Set pupilar
     *
     * @param string $pupilar
     */
    public function setPupilar($pupilar)
    {
        $this->pupilar = $pupilar;
    }

    /**
     * Get pupilar
     *
     * @return string 
     */
    public function getPupilar()
    {
        return $this->pupilar;
    }

    /**
     * Set worth
     *
     * @param string $worth
     */
    public function setWorth($worth)
    {
        $this->worth = $worth;
    }

    /**
     * Get worth
     *
     * @return string 
     */
    public function getWorth()
    {
        return $this->worth;
    }

    /**
     * Set Amsler
     *
     * @param string $amsler
     */
    public function setAmsler($amsler)
    {
        $this->Amsler = $amsler;
    }

    /**
     * Get Amsler
     *
     * @return string 
     */
    public function getAmsler()
    {
        return $this->Amsler;
    }

    /**
     * Set cita
     *
     * @param mio\mioBundle\Entity\Cita $cita
     */
    public function setCita(\mio\mioBundle\Entity\Cita $cita)
    {
        $this->cita = $cita;
    }

    /**
     * Get cita
     *
     * @return mio\mioBundle\Entity\Cita 
     */
    public function getCita()
    {
        return $this->cita;
    }
}