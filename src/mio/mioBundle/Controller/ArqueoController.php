<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Arqueo;
use mio\mioBundle\Entity\Confirmado;
use mio\mioBundle\Entity\Noconfirmado;
use mio\mioBundle\Entity\Devolucion;
use mio\mioBundle\Entity\Reserva;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ArqueoController extends Controller
{
    public function nuevoarqueoAction()
    {
    $dia = new \DateTime('now');
    $dia = $dia->format('d-m-Y');
    $chivato = 1;
    $arqueos = $this->getDoctrine()->getRepository('miomioBundle:Arqueo')->findAll();
    foreach($arqueos as $arqueo){
        if ( $arqueo->getFechaarqueo()->format('d-m-Y') == $dia)
            $chivato=0; 
    }
    return $this->render('miomioBundle:Arqueo:nuevoarqueo.html.twig',array('chivato' => $chivato));
 	}

 	public function confirmararqueoAction()
    {
    $sum=0;
    $boletas=0;

    $ventas = $this->getDoctrine()->getRepository('miomioBundle:Venta')->findAll();
     foreach($ventas as $venta){
        $now = new \DateTime('now');
        if ( $venta->getFechaoper()->format('d-m-Y') == $now->format('d-m-Y') ){
        //esta dentro
    	   if ($venta->getPago() == 'efectivo')
    		  $sum = $sum + $venta->getTotal();
    	   if ($venta->getPago() == 'tarjeta')
    		  $boletas = $boletas + 1;
            }
    	}

    $devoluciones = $this->getDoctrine()->getRepository('miomioBundle:Devolucion')->findAll();
    foreach($devoluciones as $devolucion){
        $now = new \DateTime('now');
        if ( $devolucion->getFechaoper()->format('d-m-Y') == $now->format('d-m-Y') ){
        //esta dentro
           if ($devolucion->getVenta()->getPago() == 'efectivo')
              $sum = $sum - $devolucion->getTotal();
           if ($devolucion->getVenta()->getPago() == 'tarjeta')
              $boletas = $boletas + 1;
            }
        }

    $reservas = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->findAll();
    foreach($reservas as $reserva){
        $now = new \DateTime('now');
        if ( $reserva->getFechaoper()->format('d-m-Y') == $now->format('d-m-Y') ){
        //esta dentro
           if ($reserva->getPago() == 'efectivo')
              $sum = $sum + $reserva->getAdelanto();
           if ($reserva->getPago() == 'tarjeta')
              $boletas = $boletas + 1;
            }
        }
    $array['sum'] = $sum;
    $array['boletas'] = $boletas;
    return  new Response(json_encode($array), 200, array('Content-Type', 'text/json'));
 	}

    public function guardararqueoAction()
    {
            $em = $this->get('doctrine')->getEntityManager();

            $arqueo = new Arqueo();
            $arqueo->setFechaarqueo(new \DateTime('now'));
            $efectivo = $this->getRequest()->query->get('efectivo');
            $boletas = $this->getRequest()->query->get('boletas');
            $efectivocontado = $this->getRequest()->query->get('efectivocontado');
            $boletascontadas = $this->getRequest()->query->get('boletascontadas');
            $empleado = $this->get('security.context')->getToken()->getUser();
            $arqueo->setEfectivo($efectivo);
            $arqueo->setBoletas($boletas);
            $arqueo->setBoletascont($boletascontadas);
            $arqueo->setEfectivocont($efectivocontado);
            $arqueo->setEmpleado($this->get('security.context')->getToken()->getUser());
            if ( $this->getRequest()->query->get('confirmado') == 'si')
                $arqueo->setEstado(1);
            else
                $arqueo->setEstado(0);
            
            $em->persist($arqueo);
            $em->flush();
            $this->get('session')->setFlash(
                'confirmacion',
                'El arqueo ha sido almacenado correctamente.'
            );
        }

    public function calendarioarqueosAction()
    {
        $empleados = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->findAll();
        $arqueos = $this->getDoctrine()->getRepository('miomioBundle:Arqueo')->findAll();
        return $this->render('miomioBundle:Arqueo:calendarioarqueos.html.twig',array('empleados' =>$empleados,'arqueos' => $arqueos));
    }
    
    public function listararqueoscalendarioAction($idemp){
         $return_arr = array();
          
        if ($idemp == 0)
            $arqueos = $this->getDoctrine()->getRepository('miomioBundle:Arqueo')->findAll();
        else{
                $empleado = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->find($idemp);
                $arqueos = $empleado->getArqueos();
            }
                foreach ($arqueos as $arqueo)
                {

                    if ($arqueo->getEstado() != 0){
                        $array['id'] = (string)$arqueo->getId();
                        $t = $this->get('translator')->trans('Realizado por');
                        $array['title'] = $t .': '.$arqueo->getEmpleado()->getUsername();
                        $array['hora'] = $arqueo->getFechaarqueo()->format('H:i:s');
                        $array['empleado'] = $arqueo->getEmpleado()->getUsername();
                        $array['start'] = $arqueo->getFechaarqueo()->format('Y-m-d H:i:s');
                        $array['color'] = 'green';
                        $array['allDay'] = true;
                        array_push($return_arr,$array);
                }
                else{
                    $array['id'] = (string)$arqueo->getId();
                    $array['title'] = "";
                    $array['empleado'] = $arqueo->getEmpleado()->getUsername();
                    $array['hora'] = $arqueo->getFechaarqueo()->format('H:i:s');
                    $array['boletas'] = $arqueo->getBoletas();
                    $array['boletascontado'] = $arqueo->getBoletascont();
                    $array['efectivo'] = $arqueo->getEfectivo();
                    $array['efectivocontado'] = $arqueo->getEfectivocont();
                    $array['start'] = $arqueo->getFechaarqueo()->format('Y-m-d H:i:s');
                    $array['color'] = '#FA476E';
                    $array['allDay'] = true;
                    array_push($return_arr,$array); 
                }
                $array="";
            }
            return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
    }
}
?>