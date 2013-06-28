<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Reserva;
use mio\mioBundle\Entity\Lineasoperacion;

class ApartadoController extends Controller{
	
	public function newapartadoAction()
	{	
		$clientes = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->findAll();
		return ($this->render('miomioBundle:Apartado:newapartado.html.twig',array('clientes' => $clientes)));	
	
	}
	
	public function listarapartadosAction()
	{	
		$reservas = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->findBy(array('apartado'=> 'si'));
		return ($this->render('miomioBundle:Apartado:listaapartado.html.twig',array('reservas' => $reservas)));	
	
	}

}
?>