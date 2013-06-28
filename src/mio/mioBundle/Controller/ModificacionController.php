<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use mio\mioBundle\Entity\Empleado;

class ModificacionController extends Controller{
	
	public function listarcambiosAction($id)
	{	
		if ($id != 0)
		$modificaciones = $this->getDoctrine()->getRepository('miomioBundle:Modificacion')
               ->findBy(
                   array(),        // $where 
                   array('fechamod' => 'DESC'),    // $orderBy
                   $id,                        // $limit
                   0                          // $offset
                 );
        else
			$modificaciones = $this->getDoctrine()->getRepository('miomioBundle:Modificacion')->findAll();
		
		return ($this->render('miomioBundle:Modificacion:listamodificacion.html.twig',array('modificaciones' => $modificaciones)));	
	}

}
?>