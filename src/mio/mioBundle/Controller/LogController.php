<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use mio\mioBundle\Entity\Empleado;

class LogController extends Controller{
	
	public function listarconexionesAction()
	{	
		$logs = $this->getDoctrine()->getRepository('miomioBundle:Log')->findAll();
		return ($this->render('miomioBundle:Log:listalog.html.twig',array('logs' => $logs)));	
	}
}
?>