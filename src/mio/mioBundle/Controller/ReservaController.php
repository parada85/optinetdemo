<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Reserva;
use Ps\PdfBundle\Annotation\Pdf;
use mio\mioBundle\Entity\Lineasoperacion;

class ReservaController extends Controller{
	
	public function newreservaAction()
	{	
		$clientes = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->findAll();
		return ($this->render('miomioBundle:Reserva:newreserva.html.twig',array('clientes' => $clientes)));	
	
	}
	
	public function listarreservasAction()
	{	
		$reservas = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->findBy(array('apartado'=> 'no'));
		return ($this->render('miomioBundle:Reserva:listareserva.html.twig',array('reservas' => $reservas)));	
	
	}

	public function avisadaAction($id)
	{	
		$em = $this->get('doctrine')->getEntityManager();
		$reserva = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->find($id);
		$reserva->setAvisada(new \DateTime('now'));
		$lineas = $reserva->getLineas();
		foreach ($lineas as $linea){
			$linea->getProducto()->setReservado($linea->getProducto()->getReservado() - $linea->getCantidad());//decremento reservado
			$linea->getProducto()->setStock($linea->getProducto()->getStock() - $linea->getCantidad());//decremento stock
			$linea->getProducto()->setApartado($linea->getProducto()->getApartado() + $linea->getCantidad());//aumento apartado
		}
		$em->persist($reserva);
		$em->flush();
		return new Response();
	}


	/**
 * @Pdf()
 */
	public function generardocumentoreservaAction($id)
	{
    //$format = $this->get('request')->get('_format');
    $reserva = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->find($id);
    $lineas = $reserva->getLineas();
    $cliente = $reserva->getCliente();
    $empleado = $reserva->getEmpleado();
    $pdf = $this->render(sprintf('miomioBundle:Reserva:reserva.pdf.twig'), array('cliente' => $cliente,'empleado' => $empleado,
        'reserva' => $reserva,
        'lineas' => $lineas
        ));

    /*$facade = $this->get('ps_pdf.facade');
    $xml = $pdf->getContent();    
    $content = $facade->render($xml);    
    $pdf1 = new Response($content, 200, array('content-type' => 'application/pdf'));
    file_put_contents('venta'.$venta->getId().'.pdf', $pdf1);
    */
    return $pdf;
	}

}
?>