<?php

namespace mio\mioBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use mio\mioBundle\Entity\Proveedor;
use mio\mioBundle\Entity\Pedido;
use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Lineaspedido;
use Symfony\Component\HttpFoundation\Response;
use Ps\PdfBundle\Annotation\Pdf;

class PedidoController extends Controller{
	
	
	public function newpedidoAction()
	{	
		$proveedores = $this->getDoctrine()->getRepository('miomioBundle:Proveedor')->findAll();
		return $this->render('miomioBundle:Pedido:newpedido.html.twig',array('proveedores' => $proveedores));	
	}
	
	public function listarpedidosAction()
	{	
		$pedidos = $this->getDoctrine()->getRepository('miomioBundle:Pedido')->findAll();
		return ($this->render('miomioBundle:Pedido:listapedido.html.twig',array('pedidos' => $pedidos)));	
	
	}

	public function productospedidoAction($id)
	{
		$return_arr = array();
		$unidades="unidad/es";
		$t = $this->get('translator')->trans($unidades);
		$pedido = $this->getDoctrine()->getRepository('miomioBundle:Pedido')->find($id);
		$lineas = $pedido->getLineaspedido();
			foreach ($lineas as $linea){

				$row_array['id'] = $linea->getProducto()->getId();	
				$row_array['cantidad'] = $linea->getCantidad().' '.$t;
				$row_array['descripcion'] = $linea->getProducto()->getDescripcion();	
				$row_array['pcompra'] = $linea->getPrecio().' €';
				$row_array['iva'] = $linea->getIva().' %';
				$row_array['total'] = $linea->getCantidad() * $linea->getPrecio().' €';
				array_push($return_arr,$row_array);	
		}
		return new Response ('{"iTotalRecords": "' .count($lineas). '","iTotalDisplayRecords": "' .count($lineas). '","aaData": '.json_encode($return_arr).'}');
	}
/**
 * @Pdf()
 */
	public function generardocumentopedidoAction($id)
	{
    //$format = $this->get('request')->get('_format');
    $pedido = $this->getDoctrine()->getRepository('miomioBundle:Pedido')->find($id);
    $lineas = $pedido->getLineaspedido();
    $proveedor = $pedido->getProveedor();
    $empleado = $pedido->getEmpleado();
    $empleado1 = $pedido->getRecepciona();
    $pdf = $this->render(sprintf('miomioBundle:Pedido:pedido.pdf.twig'), array('proveedor' => $proveedor,'empleado' => $empleado,
    	'empleado1' => $empleado1,
        'pedido' => $pedido,
        'lineas' => $lineas
        ));
     return $pdf;
	}
}
?>