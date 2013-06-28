<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Lineasoperacion;
use Ps\PdfBundle\Annotation\Pdf;

class DevolucionController extends Controller{
	
	
	public function productosdevolucionAction($operacionid)
	{
		$return_arr = array();
		$unidades="unidad/es";
		$t = $this->get('translator')->trans($unidades);
		$operacion = $this->getDoctrine()->getRepository('miomioBundle:Operacion')->find($operacionid);
		$lineas = $operacion->getLineas();
			foreach ($lineas as $linea){

				$row_array['id'] = $linea->getProducto()->getId();	
				$row_array['cantidad'] = $linea->getCantidad().' '.$t;
				$row_array['descripcion'] = $linea->getProducto()->getDescripcion();
				$row_array['estado'] = $this->get('translator')->trans($linea->getEstado());
				$row_array['pventa'] = $linea->getPrecio().' €';
				$row_array['iva'] = $linea->getIva().' %';
				$row_array['total'] = $linea->getCantidad() * $linea->getPrecio().' €';
				array_push($return_arr,$row_array);	
		}
		return new Response ('{"iTotalRecords": "' .count($lineas). '","iTotalDisplayRecords": "' .count($lineas). '","aaData": '.json_encode($return_arr).'}');
	}

	public function newdevolucionAction()
	{	
		$ventas = $this->getDoctrine()->getRepository('miomioBundle:Venta')->findAll();
		return ($this->render('miomioBundle:Devolucion:newdevolucion.html.twig',array('ventas' => $ventas)));	
	}
	
	public function listardevolucionesAction()
	{	
		$devoluciones = $this->getDoctrine()->getRepository('miomioBundle:Devolucion')->findAll();
		return ($this->render('miomioBundle:Devolucion:listadevolucion.html.twig',array('devoluciones' => $devoluciones)));	
	
	}

	/**
 	* @Pdf()
 	*/
	public function generardocumentodevolucionAction($id)
	{
    //$format = $this->get('request')->get('_format');
    $devolucion = $this->getDoctrine()->getRepository('miomioBundle:Devolucion')->find($id);
    $lineas = $devolucion->getLineas();
    $cliente = $devolucion->getCliente();
    $empleado = $devolucion->getEmpleado();
    $pdf = $this->render(sprintf('miomioBundle:Devolucion:documentodevolucion.pdf.twig'), array('cliente' => $cliente,'empleado' => $empleado,
        'devolucion' => $devolucion,
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