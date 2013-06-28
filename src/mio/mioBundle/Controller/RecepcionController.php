<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\Collection;

use mio\mioBundle\Entity\Empleado;

class RecepcionController extends Controller
{
    
    public function recepcionAction()
    {
    	$id = $this->getRequest()->query->get('id');
    	$em = $this->get('doctrine')->getEntityManager();
		$pedido = $this->getDoctrine()->getRepository('miomioBundle:Pedido')->find($id);
		$pedido->setFecharecepcion(new \Datetime());
    	$lineas = $pedido->getLineaspedido();
    	foreach($lineas as $linea){
    		$producto = $linea->getProducto();
    		$producto->setStock($producto->getStock() + $linea->getCantidad());//sumo lo que tnego y lo del pedido
    		$em->persist($producto);
    		}
    		
    	$empleado = $this->get('security.context')->getToken()->getUser();
    	$pedido->setRecepciona($empleado);
    	$em->persist($pedido);
    	$em->flush();
        
    	return new Response();
    }
}
