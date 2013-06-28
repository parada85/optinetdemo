<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Devolucion;
use mio\mioBundle\Entity\Reserva;

use Symfony\Component\HttpFoundation\Request;


class OperacionController extends Controller{
	
	public function indexAction(){

		$em = $this->get('doctrine')->getEntityManager();
        $ventas = $em->getRepository('miomioBundle:Venta')->findAll();
        $devoluciones = $em->getRepository('miomioBundle:Devolucion')->findAll();
        $reservas = $em->getRepository('miomioBundle:Reserva')->findAll();
        return $this->render('miomioBundle:Operacion:index.html.twig',array('ventas' => $ventas,'devoluciones' => $devoluciones,'reservas'=>$reservas));
	   }
	}
?>