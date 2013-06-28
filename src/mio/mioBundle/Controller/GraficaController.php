<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Medico;
use mio\mioBundle\Entity\Producto;
use mio\mioBundle\Entity\Proveedor;
use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Cita;
use mio\mioBundle\Entity\Festivo;
use mio\mioBundle\Entity\Modificacion;
use mio\mioBundle\Entity\Pedido;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Reserva;
use mio\mioBundle\Entity\Operacion;
use mio\mioBundle\Entity\Devolucion;
use mio\mioBundle\Entity\Arqueo;

class GraficaController extends Controller{
	
	
	public function graficasAction()
	{	
		return ($this->render('miomioBundle:Grafica:graficas.html.twig'));	
	
	}
		public function graficasempAction()
	{	
		return ($this->render('miomioBundle:Grafica:graficasemp.html.twig'));	
	
	}

	public function pintarAction($id)
	{	
		$return_arr = array();
		$prueba = array();

		if ($id == 1){
			$empleados = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->findAll();
			foreach ($empleados as $empleado)
			{
				$nventas = 0;
				$ndevoluciones = 0;
				$nreservas = 0;
				$napartados = 0;
				$ncitas = 0;
				$npedidos = 0;
				$operaciones = $empleado->getOperaciones();

				foreach ($operaciones as $operacion){
					if ($operacion instanceof Venta){
						$nventas++;
						continue;
					}
					if ($operacion instanceof Reserva){
						if ($operacion->getApartado() == 'no')
							$nreservas++;
						else
							$napartados++;
						continue;
					}
					if ($operacion instanceof Devolucion){
						$ndevoluciones++;
						continue;
					}
					if ($operacion instanceof Cita){
						$ncitas++;
						continue;
					}
				}

				$array['username'] = ucfirst($empleado->getUsername());
				$array['nventas'] = $nventas;
				$array['nreservas'] = $nreservas;
				$array['napartados'] = $napartados;
				$array['ndevoluciones'] = $ndevoluciones;
				$array['ncitas'] = $ncitas;
				$array['npedidos'] = $empleado->getPedidos()->count();
				array_push($return_arr,$array);
				}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
			}

		if ($id == 2){

			$empleados = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->findAll();
			foreach ($empleados as $empleado)
			{
				$total=0;
				$operaciones = $empleado->getOperaciones();
				foreach ($operaciones as $operacion){
					if ($operacion instanceof Venta){
						$total += $operacion->getTotal();
						continue;
					}
					if ($operacion instanceof Reserva){
						$total += $operacion->getAdelanto();
						continue;
					}
					if ($operacion instanceof Devolucion){
						$total -= $operacion->getTotal();
						continue;
					}
				}
				$array['username'] = ucfirst($empleado->getUsername());
				$array['total'] = $total;
				array_push($return_arr,$array);
			}
			
			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
			}

		if ($id == 3){//productos mas vendidos

			$productos = $this->getDoctrine()->getRepository('miomioBundle:Producto')->findAll();
				foreach ($productos as $producto){//para cada producto...
						$cantidad = 0;
						$chivato = 0;
						$lineasoperacion = $producto->getPlineas();
						foreach ($lineasoperacion as $linea){
							if ($this->getDoctrine()->getRepository('miomioBundle:Venta')->find($linea->getOperacion()->getId())){
								$chivato=1;
								$array['descripcion'] = $producto->getDescripcion();
								$cantidad += $linea->getCantidad();
							}
						}
						if ($chivato==1) {
							$array['cantidad'] = $cantidad;
							array_push($return_arr,$array);
						}
					}

					foreach ($return_arr as $key => $row) { //ordeno el array
 					   $aux[$key] = $row['cantidad'];
					}
					array_multisort($aux, SORT_DESC, $return_arr);

					if (count($return_arr) > 7){
						for($i = 0; $i < 7; $i++)
							array_push($prueba,$return_arr[$i]);
					return  new Response(json_encode($prueba), 200, array('Content-Type', 'text/json'));
					}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}
		if ($id == 'ventas'){
			$ventas = $this->getDoctrine()->getRepository('miomioBundle:Venta')->findAll();
			foreach ($ventas as $venta) {
				$array['fecha'] = $venta->getFechaoper()->getTimestamp()*1000;
				$array['total'] = $venta->getTotal();
				array_push($return_arr,$array);
				}
			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}

		if ($id == 'reservas'){
			$reservas = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->findBy(array('apartado'=> 'no'));
			foreach ($reservas as $reserva) {
				$array['fecha'] = $reserva->getFechaoper()->getTimestamp()*1000;
				$array['total'] = $reserva->getTotal();
				array_push($return_arr,$array);
			}
			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}

		if ($id == 'apartados'){
			$apartados = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->findBy(array('apartado'=> 'si'));
			foreach ($apartados as $apartado) {
				if ($apartado->getApartado() == 'si'){
				$array['fecha'] = $apartado->getFechaoper()->getTimestamp()*1000;
				$array['total'] = $apartado->getTotal();
				array_push($return_arr,$array);
				}
			}
			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}

		if ($id == 'devoluciones'){
			$devoluciones = $this->getDoctrine()->getRepository('miomioBundle:Devolucion')->findAll();
			foreach ($devoluciones as $devolucion) {
				$array['fecha'] = $devolucion->getFechaoper()->getTimestamp()*1000;
				$array['total'] = $devolucion->getTotal();
				array_push($return_arr,$array);
				}
			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}


		if ($id == 4){
			$suma = 0;
			$resta = 0;
			$em = $this->getDoctrine()->getEntityManager();
			$operaciones = $operaciones = $this->getDoctrine()->getRepository('miomioBundle:Operacion')->findAll();
			foreach ($operaciones as $operacion){
				if (!$operacion instanceof Cita ){
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					break;
				}
			}

			$len = count($operaciones);
			$iter = 1;
			foreach($operaciones as $operacion){
				if ( $fecha == $operacion->getFechaoper()->format('d-m-Y')){
					if ( $operacion instanceof Venta )
						$suma += $operacion->getTotal();
					if ( $operacion instanceof Reserva)
						$suma += $operacion->getAdelanto();
					if ($operacion instanceof Devolucion)
						$resta += $operacion->getTotal();
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					}
				}
				else{
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					$suma = 0;
					$resta = 0;
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					if ( $operacion instanceof Venta )
						$suma += $operacion->getTotal();
					if ( $operacion instanceof Reserva)
						$suma += $operacion->getAdelanto();
					if ($operacion instanceof Devolucion)
						$resta += $operacion->getTotal();
					
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					}
				}
				$iter++;
			}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}


		if ($id == 5){
			$suma = 0;
			$resta = 0;
			$em = $this->getDoctrine()->getEntityManager();
			$operaciones = $operaciones = $this->getDoctrine()->getRepository('miomioBundle:Operacion')->findAll();
			foreach ($operaciones as $operacion){
				if (!$operacion instanceof Cita ){
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					break;
				}
			}

			$len = count($operaciones);
			$iter = 1;
			foreach($operaciones as $operacion){
				if ( $fecha == $operacion->getFechaoper()->format('d-m-Y')){
					if ( $operacion instanceof Venta )
						$suma += $operacion->getTotal();
					if ( $operacion instanceof Reserva)
						$suma += $operacion->getAdelanto();
					if ($operacion instanceof Devolucion)
						$resta += $operacion->getTotal();
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					}
				}
				else{
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					if ( $operacion instanceof Venta )
						$suma += $operacion->getTotal();
					if ( $operacion instanceof Reserva)
						$suma += $operacion->getAdelanto();
					if ($operacion instanceof Devolucion)
						$resta += $operacion->getTotal();
					
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					}
				}
				$iter++;
			}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}

		if ($id == 6){
			$suma = 0;
			$sumacoste = 0;
			$resta = 0;
			$restacoste = 0;
			$em = $this->getDoctrine()->getEntityManager();
			$operaciones = $operaciones = $this->getDoctrine()->getRepository('miomioBundle:Operacion')->findAll();
			foreach ($operaciones as $operacion){
				if (!$operacion instanceof Cita ){
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					break;
				}
			}

			$len = count($operaciones);
			$iter = 1;
			foreach($operaciones as $operacion){

				$lineas = $operacion->getLineas();
				if ( $fecha == $operacion->getFechaoper()->format('d-m-Y')){
					if ( $operacion instanceof Venta ){
						$suma += $operacion->getTotal();
						foreach ($lineas as $linea){
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
							}
					}
					if ( $operacion instanceof Reserva){
						$suma += $operacion->getAdelanto();
						foreach ($lineas as $linea)
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($operacion instanceof Devolucion){
						$resta += $operacion->getTotal();
						foreach ($lineas as $linea)
							$restacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $sumacoste - $resta - $restacoste;
					array_push($return_arr,$array);
					}
				}
				else{
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $sumacoste - $resta - $restacoste;
					array_push($return_arr,$array);
					$suma = 0;
					$resta = 0;
					$sumacoste = 0;
					$restacoste = 0;
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					if ( $operacion instanceof Venta ){
						$suma += $operacion->getTotal();
						foreach ($lineas as $linea)
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ( $operacion instanceof Reserva){
						$suma += $operacion->getAdelanto();
						foreach ($lineas as $linea)
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($operacion instanceof Devolucion){
						$resta += $operacion->getTotal();
						foreach ($lineas as $linea)
							$restacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $sumacoste - $resta - $restacoste;
					array_push($return_arr,$array);
					}
				}
				$iter++;
			}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}

		if ($id == 7){
			$suma = 0;
			$sumacoste = 0;
			$resta = 0;
			$restacoste = 0;
			$em = $this->getDoctrine()->getEntityManager();
			$operaciones = $operaciones = $this->getDoctrine()->getRepository('miomioBundle:Operacion')->findAll();
			foreach ($operaciones as $operacion){
				if (!$operacion instanceof Cita ){
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					break;
				}
			}

			$len = count($operaciones);
			$iter = 1;
			foreach($operaciones as $operacion){

				$lineas = $operacion->getLineas();
				if ( $fecha == $operacion->getFechaoper()->format('d-m-Y')){
					if ( $operacion instanceof Venta ){
						$suma += $operacion->getTotal();
						foreach ($lineas as $linea){
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
							}
					}
					if ( $operacion instanceof Reserva){
						$suma += $operacion->getAdelanto();
						foreach ($lineas as $linea)
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($operacion instanceof Devolucion){
						$resta += $operacion->getTotal();
						foreach ($lineas as $linea)
							$restacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $sumacoste - $resta - $restacoste;
					array_push($return_arr,$array);
					}
				}
				else{
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $sumacoste - $resta - $restacoste;
					array_push($return_arr,$array);
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					if ( $operacion instanceof Venta ){
						$suma += $operacion->getTotal();
						foreach ($lineas as $linea)
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ( $operacion instanceof Reserva){
						$suma += $operacion->getAdelanto();
						foreach ($lineas as $linea)
							$sumacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($operacion instanceof Devolucion){
						$resta += $operacion->getTotal();
						foreach ($lineas as $linea)
							$restacoste += $linea->getPcompra() * $linea->getCantidad();
					}
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $sumacoste - $resta - $restacoste;
					array_push($return_arr,$array);
					}
				}
				$iter++;
			}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}

		if ($id == 8){
			$empleados = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->findAll();
			foreach ($empleados as $empleado)
			{
				$noconfirmado = 0;
				$confirmado = 0;
				$arqueos = $empleado->getArqueos();

				foreach ($arqueos as $arqueo){
					if ($arqueo->getEstado())
						$confirmado++;
					else
						$noconfirmado++;
					}

				$array['username'] = ucfirst($empleado->getUsername());
				$array['noconfirmado'] = $noconfirmado;
				$array['confirmado'] = $confirmado;
				array_push($return_arr,$array);
				}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
			}
	}

	public function pintar1Action($id)
	{	
	$return_arr = array();
		
		if ($id == 1){
			$nventas=0;
			$ndevoluciones=0;
			$nreservas=0;
			$napartados=0;
			$npedidos=0;
			$ncitas=0;

			$empleado = $this->get('security.context')->getToken()->getUser();
			$operaciones = $empleado->getOperaciones();

			foreach ($operaciones as $operacion){
					if ($operacion instanceof Venta){
						$nventas++;
						continue;
					}
					if ($operacion instanceof Reserva){
						if ($operacion->getApartado() == 'no')
							$nreservas++;
						else
							$napartados++;
						continue;
					}
					if ($operacion instanceof Devolucion){
						$ndevoluciones++;
						continue;
					}
					if ($operacion instanceof Cita){
						$ncitas++;
						continue;
					}
				}

				$array['tipo'] = $this->get('translator')->trans('Venta');
				$array['cantidad'] = $nventas;
				array_push($return_arr,$array);
				$array['tipo'] = $this->get('translator')->trans('Devolución');
				$array['cantidad'] = $ndevoluciones;
				array_push($return_arr,$array);
				$array['tipo'] = $this->get('translator')->trans('Reserva');
				$array['cantidad'] = $nreservas;
				array_push($return_arr,$array);
				$array['tipo'] = $this->get('translator')->trans('Apartado');
				$array['cantidad'] = $napartados;
				array_push($return_arr,$array);
				$array['tipo'] = $this->get('translator')->trans('Cita');
				$array['cantidad'] = $ncitas;
				array_push($return_arr,$array);
				$array['tipo'] = $this->get('translator')->trans('Pedido');
				$array['cantidad'] = $empleado->getPedidos()->count();
				array_push($return_arr,$array);
			
			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
			}

			if ($id == 2){

			$suma = 0;
			$resta = 0;
			$em = $this->getDoctrine()->getEntityManager();
			$empleado = $this->get('security.context')->getToken()->getUser();
			$operaciones = $empleado->getOperaciones();
			foreach ($operaciones as $operacion){
				if (!$operacion instanceof Cita ){
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					break;
				}
			}

			$len = count($operaciones);
			$iter = 1;
			foreach($operaciones as $operacion){
				if ( $fecha == $operacion->getFechaoper()->format('d-m-Y')){
					if ( $operacion instanceof Venta )
						$suma += $operacion->getTotal();
					if ( $operacion instanceof Reserva)
						$suma += $operacion->getAdelanto();
					if ($operacion instanceof Devolucion)
						$resta += $operacion->getTotal();
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					}
				}
				else{
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					$suma = 0;
					$resta = 0;
					$fecha = $operacion->getFechaoper()->format('d-m-Y');
					if ( $operacion instanceof Venta )
						$suma += $operacion->getTotal();
					if ( $operacion instanceof Reserva)
						$suma += $operacion->getAdelanto();
					if ($operacion instanceof Devolucion)
						$resta += $operacion->getTotal();
					
					if ($iter == $len){
					$array['fecha'] = strtotime($fecha)*1000; //timestamp
					$array['total'] = $suma - $resta;
					array_push($return_arr,$array);
					}
				}
				$iter++;
			}

			return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
		}
	}
}

?>