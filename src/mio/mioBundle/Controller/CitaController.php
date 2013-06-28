<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use mio\mioBundle\Entity\Cita;
use mio\mioBundle\Entity\Festivo;
use mio\mioBundle\Entity\Medico;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use mio\mioBundle\Form\CitaType;
use mio\mioBundle\Form\FestivoType;


/**
 * Cita controller.
 *
 * @Route("/cita")
 */
class CitaController extends Controller
{

    /**
     * Finds and displays a Cita entity.
     *
     * @Route("/{id}/show", name="cita_show")
     * @Template()
     */
    public function vercitaAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Cita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cita entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CitaType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }
    /**
     * Finds and displays a Festivo entity.
     *
     * @Route("/{id}/show", name="festivo_show")
     * @Template()
     */

    public function verfestivoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Festivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cita entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FestivoType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    public function newcitaAction()
    {   
        $clientes = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->findAll();
        $medicos = $this->getDoctrine()->getRepository('miomioBundle:Medico')->findAll();
        $citas = $this->getDoctrine()->getRepository('miomioBundle:Cita')->findAll();
        //$fecha = new \DateTime($fecha);
        //'fecha' => $fecha->format('d-m-Y H:i:s'))
        return $this->render('miomioBundle:Cita:newcita.html.twig',array('medicos'=>$medicos,'clientes' => $clientes,'citas' => $citas));
    }

    public function comprobarcitaAction()
    {

        $fechacita = new \DateTime($this->getRequest()->query->get('fecha'));
        
        $citas = $this->getDoctrine()->getRepository('miomioBundle:Cita')->findBy(array('fechacita' => $fechacita));
        foreach ($citas as $cita){
            if ($cita->getMedico()->getId() == $this->getRequest()->query->get('medico'))
                return new Response(0);//error medico ocupado esa fecha
            if ($cita->getCliente()->getId() == $this->getRequest()->query->get('cliente'))
                return new Response(0);//error cliente ocupado esa fecha
        }
        return new Response(1);
    }

    public function comprobarcitafestivoAction()
    {

        $fechacita = new \DateTime($this->getRequest()->query->get('fecha'));

        $festivos = $this->getDoctrine()->getRepository('miomioBundle:Festivo')->findAll();
        foreach ($festivos as $festivo)
            if ($festivo->getFecha()->format("Y-m-d") == $fechacita->format("Y-m-d") )
                return new Response(0);//error existe un festivo.
        return new Response(1);
    }

    public function obtenerdatoscitaAction()
    {
        $return_arr = array();
        $citaid = $this->getRequest()->query->get('citaid');
        $cita = $this->getDoctrine()->getRepository('miomioBundle:Cita')->find($citaid);
        $array['cliente'] = $cita->getCliente()->getId();
        $array['medico'] = $cita->getMedico()->getId();
        $array['fecha'] = $cita->getFechacita()->format('d-m-Y H:i:s');
        array_push($return_arr,$array);
        return new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
    }

    public function comprobarfestivoAction()
    {

        $fechafestivo = new \DateTime($this->getRequest()->query->get('fecha'));
        $festivos = $this->getDoctrine()->getRepository('miomioBundle:Festivo')->findAll();
        foreach($festivos as $festivo)
            if ($festivo->getFecha() == $fechafestivo)
                return new Response(0);

        $fechafestivo = $fechafestivo->format("Y-m-d");
        $citas = $this->getDoctrine()->getRepository('miomioBundle:Cita')->findAll();

        foreach($citas as $cita)
            if ($cita->getFechacita()->format("Y-m-d") == $fechafestivo)
                return new Response(0);
        return new Response(1);
    }

    public function comprobarmedicoAction()
    {

        $return_arr = array();
        $interval = new \DateInterval("P1D");

        $fecha = new \DateTime($this->getRequest()->query->get('fecha'));
        $medicos = $this->getDoctrine()->getRepository('miomioBundle:Medico')->findAll();
        foreach ($medicos as $medico){
            $chivato = 1;
        foreach($medico->getPermisos() as $permiso){
            $i = $permiso->getInicio();
            //echo $permiso->getInicio()->format('Y-m-d H:i:s').'</br>';
            $f = $permiso->getFin();
            //echo $permiso->getFin()->format('Y-m-d H:i:s').'</br>';
            $f = $f->modify( '+1 day' );
            $daterange = new \DatePeriod($i, $interval ,$f);
            if (iterator_count($daterange) == 0) // si no existe un intervalo de fechas
                            if ($permiso->getInicio()->format("Y-m-d") == $fecha->format("Y-m-d")){
                                $chivato =0;
                            }
            foreach($daterange as $date)
                if ($date->format("Y-m-d") == $fecha->format("Y-m-d")){
                    $chivato = 0;
                }
        }
        if ($chivato == 1 && $medico->isEnabled()){
                $array['id'] = ucfirst($medico->getId());
                $array['nombre'] = ucfirst($medico->getUsername());
                array_push($return_arr,$array);
            }
        }
    return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));

    }

    public function comprobarmedico1Action()
    {

        $return_arr = array();
        $interval = new \DateInterval("P1D");
        $chivato = 1;

        $fecha = new \DateTime($this->getRequest()->query->get('fecha'));
        $medico = $this->getDoctrine()->getRepository('miomioBundle:Medico')->find($this->getRequest()->query->get('medico'));
        if ($medico->isEnabled()){
            foreach($medico->getPermisos() as $permiso){
                $i = $permiso->getInicio();
                $f = $permiso->getFin();
                $f = $f->modify( '+1 day' );
                $daterange = new \DatePeriod($i, $interval ,$f);
                if (iterator_count($daterange) == 0) // si no existe un intervalo de fechas
                                if ($permiso->getInicio()->format("Y-m-d") == $fecha->format("Y-m-d")){
                                    $chivato = 0;
                                }
                foreach($daterange as $date)
                    if ($date->format("Y-m-d") == $fecha->format("Y-m-d")){
                        $chivato = 0;
                    }
            }
            if ($chivato == 1)
                return new Response(1);
            else
                return new Response(0);
        }
        else
            return new Response(0);
    }
    
    public function guardarcitaAction()
    {
        //comprobar antes de guardar
        $em = $this->get('doctrine')->getEntityManager();
        $cita = new Cita();
        $empleado = $this->get('security.context')->getToken()->getUser();
        $cita->setEmpleado($empleado);
        $cliente = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->find($this->getRequest()->query->get('cliente'));
        $cita->setFechacita(new \DateTime($this->getRequest()->query->get('fecha')));
        $cita->setCliente($cliente);//asociacion de cita a usuario.
        $cita->setFechaoper(new \DateTime('now'));
        $medico = $this->getDoctrine()->getRepository('miomioBundle:Medico')->find($this->getRequest()->query->get('medico'));
        $cita->setMedico($medico);
        $em->persist($cita);
        $em->flush();
        $medico->addCita($cita);

        $em->persist($cita);
        $em->persist($cliente);
        $em->persist($empleado);
        $em->persist($medico);
        $em->flush();

        return new Response();
    }

    public function modificarcitaAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $cita = $this->getDoctrine()->getRepository('miomioBundle:Cita')->find($this->getRequest()->query->get('idcita'));
        $empleado = $this->get('security.context')->getToken()->getUser();
        $cita->setEmpleado($empleado);
        $cita->setFechacita(new \DateTime($this->getRequest()->query->get('fecha')));
        $cita->setFechaoper(new \DateTime('now'));
        $em->persist($cita);
        $em->flush();
        $em->persist($cita);
        $em->persist($empleado);
        $em->flush();
        return new Response();
    }

    public function borrarcitaAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $cita = $this->getDoctrine()->getRepository('miomioBundle:Cita')->find($id);
        $em->remove($cita);
        $em->flush();
    }

    public function borrarfestivoAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $festivo = $this->getDoctrine()->getRepository('miomioBundle:Festivo')->find($id);
        $em->remove($festivo);
        $em->flush();
    }

    public function listarcitascalendarioAction($id)
    {
        $return_arr = array();
        if ($id==0)
             $citas = $this->getDoctrine()->getRepository('miomioBundle:Cita')->findAll();
        else
            $citas = $this->getDoctrine()->getRepository('miomioBundle:Medico')->find($id)->getCitas();

        foreach($citas as $cita){
                    $array['id'] = (string)$cita->getId();
                    $array['title'] = $cita->getCliente()->getNombre();
                    $array['empleado'] = $cita->getEmpleado()->getUsername();
                    $array['apellido1'] = $cita->getCliente()->getApellido1();
                    if ($cita->getCliente()->getMovil())
                        $array['contacto'] = $cita->getCliente()->getMovil();
                    else
                        if ($cita->getCliente()->getTelefono())
                            $array['contacto'] = $cita->getCliente()->getTelefono();
                        else 
                            if ($cita->getCliente()->getEmail())
                                $array['contacto'] = $cita->getCliente()->getEmail();
                            else
                                $array['contacto'] = "";

                    $array['cita'] =$cita->getId();
                    if ($cita->getInforme()!= null){//tiene informe
                        $array['informe'] = $cita->getInforme()->getId();
                        $array['color'] = 'black';
                    }
                    else{
                        $array['informe'] = 'NO';
                        $array['color'] = $cita->getMedico()->getColor();
                    }
                    $array['fecha'] = $cita->getFechaoper()->format('d-m-Y H:i:s');
                    $array['start'] = $cita->getFechacita()->format('Y-m-d H:i:s');
                    $array['allDay'] = false;
                    
                array_push($return_arr,$array);
         }
         
    return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
    }

    public function listarcitasAction()
    {
        $return_arr = array();
        
        $citas = $this->getDoctrine()->getRepository('miomioBundle:Cita')->findAll();

        foreach($citas as $cita){
                    $array['dni'] = $cita->getCliente()->getDni();
                    $array['nombre'] = $cita->getCliente()->getNombre();
                    $array['apellido1'] = $cita->getCliente()->getApellido1();
                    $array['apellido2'] = $cita->getCliente()->getApellido2();
                    $array['realizada'] = $cita->getEmpleado()->getUsername();
                    $array['medico'] = $cita->getMedico()->getUsername();
                    $array['fecha'] = $cita->getFechaoper()->format('d/m/Y H:i:s');
                    $array['fecha cita'] = $cita->getFechacita()->format('d/m/Y H:i:s');
                array_push($return_arr,$array);
         }
         
   return new Response ('{"iTotalRecords": "' .count($citas). '","iTotalDisplayRecords": "' .count($citas). '","aaData": '.json_encode($return_arr).'}');
    }

    public function listarfestivosAction()
    {
        $return_arr = array();
        
        $festivos = $this->getDoctrine()->getRepository('miomioBundle:Festivo')->findAll();

        foreach($festivos as $festivo){
                    $array['fecha'] = $festivo->getFecha()->format('d/m/Y');
                array_push($return_arr,$array);
         }
         
   return new Response ('{"iTotalRecords": "' .count($festivos). '","iTotalDisplayRecords": "' .count($festivos). '","aaData": '.json_encode($return_arr).'}');
    }

    public function festivosAction()
    {
        $return_arr = array();
        $festivos = $this->getDoctrine()->getRepository('miomioBundle:Festivo')->findAll();
            foreach($festivos as $festivo){
                    $array1['id'] = (string)$festivo->getId();
                    $array1['title'] = $this->get('translator')->trans('Festivo');
                    $array1['start'] = $festivo->getFecha()->format('Y-m-d H:i:s');
                    $fecha = new \DateTime($festivo->getFecha()->format('Y-m-d H:i:s'));
                    $fecha->modify('+11 hours');
                    $array1['end'] = $fecha->format('Y-m-d H:i:s');
                    $array1['allDay'] = false;
                array_push($return_arr,$array1);
            }
    return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
    }

    public function gestionfestivoAction()
    {
        return ($this->render('miomioBundle:Cita:gestionfestivo.html.twig'));
    }
    public function guardarfestivoAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $festivo = new Festivo();
        $festivo->setFecha(new \DateTime($this->getRequest()->query->get('fecha')));
        $em->persist($festivo);
        $em->flush();
    }

    public function seleccionparacitaAction($fecha)
    {
        $clientes = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->findAll();
        $medicos = $this->getDoctrine()->getRepository('miomioBundle:Medico')->findAll();
        $fecha = new \DateTime($fecha);
        return $this->render('miomioBundle:Cita:seleccionparacita.html.twig',array('medicos'=>$medicos,'clientes' => $clientes,'fecha' => $fecha->format('d-m-Y H:i:s')));
    }



}
