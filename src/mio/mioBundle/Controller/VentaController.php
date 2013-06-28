<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ps\PdfBundle\Annotation\Pdf;
use Symfony\Component\HttpFoundation\Response;


use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Reserva;
use mio\mioBundle\Entity\Lineasoperacion;

class VentaController extends Controller{
	
	public function newventaAction()
	{	
		$clientes = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->findAll();
		return ($this->render('miomioBundle:Venta:newventa.html.twig',array('clientes' => $clientes)));	
	
	}
	
	public function listarventasAction()
	{	
		$ventas = $this->getDoctrine()->getRepository('miomioBundle:Venta')->findAll();
		return ($this->render('miomioBundle:Venta:listaventa.html.twig',array('ventas' => $ventas)));	
	
	}

	public function productosventareservaAction($operacionid)
	{
		$return_arr = array();
		$unidades="unidad/es";
		$t = $this->get('translator')->trans($unidades);
		$operacion = $this->getDoctrine()->getRepository('miomioBundle:Operacion')->find($operacionid);
		$lineas = $operacion->getLineas();
			foreach ($lineas as $linea){

				$row_array['id'] = $linea->getProducto()->getId();	
				$row_array['descripcion'] = $linea->getProducto()->getDescripcion();
				$row_array['cantidad'] = $linea->getCantidad().' '.$t;
				$row_array['pventa'] = $linea->getPrecio().' €';
				$row_array['iva'] = $linea->getIva().' %';
				$row_array['total'] = $linea->getCantidad() * $linea->getPrecio().' €';
				array_push($return_arr,$row_array);	
		}
		return new Response ('{"iTotalRecords": "' .count($lineas). '","iTotalDisplayRecords": "' .count($lineas). '","aaData": '.json_encode($return_arr).'}');
	}
/**
 * @Pdf()
 */
	public function generardocumentoventaAction($id)
	{
    //$format = $this->get('request')->get('_format');
    $venta = $this->getDoctrine()->getRepository('miomioBundle:Venta')->find($id);
    $lineas = $venta->getLineas();
    $cliente = $venta->getCliente();
    $empleado = $venta->getEmpleado();
    $pdf = $this->render(sprintf('miomioBundle:Venta:venta.pdf.twig'), array('cliente' => $cliente,'empleado' => $empleado,
        'venta' => $venta,
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