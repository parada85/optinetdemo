<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use mio\mioBundle\Entity\Permiso;
use mio\mioBundle\Entity\Empleado;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;


class PermisoController extends Controller
{
    
    public function comprobarpermisoAction()
    {
        $fecha = new \DateTime($this->getRequest()->query->get('fecha'));
        $empleado = $this->getRequest()->query->get('empleado');
        $empleado = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->findOneByUsername($empleado);
        $interval = new \DateInterval("P1D");
        $permisos = $this->getDoctrine()->getRepository('miomioBundle:Permiso')->findAll();
        $chivato = $this->getRequest()->query->get('chivato');



        if ($this->getRequest()->query->get('fin') == 'null'){//estoy en el caso 1
                    if ($chivato != 'si')
                      foreach ($permisos as $permiso){
                        if ($permiso->getTipo()!='baja' && $permiso->getTipo() == $this->getRequest()->query->get('tipo') && $permiso->getInicio()->format('Y') == $fecha->format('Y') && $empleado->getUsername() == $permiso->getEmpleado()->getUsername() )
                            return new Response(2);
                    }

                    foreach ($permisos as $permiso){
                        $i = $permiso->getInicio();
                        //echo $permiso->getInicio()->format('Y-m-d H:i:s').'</br>';
                        $f = $permiso->getFin();
                        //echo $permiso->getFin()->format('Y-m-d H:i:s').'</br>';
                        $f = $f->modify( '+1 day' );
                        $daterange = new \DatePeriod($i, $interval ,$f);
                        if (iterator_count($daterange) == 0) // si no existe un intervalo de fechas
                            if ($permiso->getInicio() == $fecha && $permiso->getEmpleado()->getId() == $empleado->getId())
                                return new Response(0);
                        foreach($daterange as $date){
                            //echo $date->format('Y-m-d H:i:s');
                            if ($date == $fecha && $permiso->getEmpleado()->getId() == $empleado->getId())
                                return new Response(0);//return 0     ---  error empleado ocupado en esa fecha
                        }
                    }
                    return new Response(1);
        }
        else{//caso 2
            $fin = new \DateTime($this->getRequest()->query->get('fin'));
            $fin1 = new \DateTime($this->getRequest()->query->get('fin'));
            if ($this->getRequest()->query->get('daydelta') != 'no'){
                $decremento = '-'. $this->getRequest()->query->get('daydelta') .'day';
                $fecha = $fin1->modify((string)$decremento);
                }
            $fin = $fin->modify( '+1 day' );
            $daterange = new \DatePeriod($fecha, $interval ,$fin);
            foreach ($daterange as $date){
                //echo "primer fecha".'</br>';
                //echo $date->format('Y-m-d H:i:s').'</br>';
                foreach ($permisos as $permiso){
                    $i = $permiso->getInicio();
                    $f = $permiso->getFin();
                    $f = $f->modify( '+1 day' );
                    //echo '</br>';
                    $daterange1 = new \DatePeriod($i, $interval ,$f);
                    foreach($daterange1 as $date1){
                        //echo $date1->format('Y-m-d H:i:s').'</br>';
                        if ($date == $date1 && $permiso->getEmpleado()->getId() == $empleado->getId()){
                                return new Response(0);//error empleado ocupado en esa fecha
                            }
                        }
                    }
                }
           return new Response(1);
        }
    }

    public function guardarpermisoAction()
    {
        //comprobar antes de guardar
        $em = $this->get('doctrine')->getEntityManager();
        $permiso = new Permiso();
        $empleado = $this->getRequest()->query->get('empleado');
        $empleado = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->findOneByUsername($empleado);
        $pieces = explode(" ", $this->getRequest()->query->get('tipo'));
        $permiso->setTipo($pieces[0]);


        $permiso->setInicio(new \DateTime($this->getRequest()->query->get('inicio')));
        if ( $this->getRequest()->query->get('fin') == 'null' )
            $permiso->setFin(new \DateTime($this->getRequest()->query->get('inicio')));
        else
             $permiso->setFin(new \DateTime($this->getRequest()->query->get('fin')));
        $permiso->setFecha(new \DateTime('now'));
        $permiso->setEmpleado($empleado);
        $em->persist($permiso);
        $em->persist($empleado);
        $em->flush();
        return new Response();
    }

    public function listarpermisoscalendarioAction()
    {
        $return_arr = array();
        
        $permisos = $this->getDoctrine()->getRepository('miomioBundle:Permiso')->findAll();

        foreach($permisos as $permiso){
                    $array['id'] = (string)$permiso->getId();
                    $array['title'] = ucwords($permiso->getEmpleado()->getUsername());
                    $array['tipo'] = $permiso->getTipo();
                    $array['fecha'] = $permiso->getFecha()->format('Y-m-d H:i:s');
                    $array['start'] = $permiso->getInicio()->format('Y-m-d H:i:s');
                    if ($permiso->getFin() != null)
                         $array['end'] = $permiso->getFin()->format('Y-m-d H:i:s');
                     else
                        $array['end'] = $permiso->getInicio()->format('Y-m-d H:i:s');
                    if ($permiso->getTipo() == 'invierno')
                    $array['color'] = '#0B610B';
                    if ($permiso->getTipo() == 'verano')
                    $array['color'] = '#9A2EFE' ;
                    if ($permiso->getTipo() == 'baja')
                    $array['color'] = '#58ACFA';
                    $array['allDay'] = true;
                array_push($return_arr,$array);
         }
         return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
     }

    public function borrarpermisoAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        if ($id == 'invierno'){
            $permisos = $this->getDoctrine()->getRepository('miomioBundle:Permiso')->findByTipo('invierno');
            foreach ($permisos as $permiso)
                $em->remove($permiso);
        }
        if ($id == 'verano'){
            $permisos = $this->getDoctrine()->getRepository('miomioBundle:Permiso')->findByTipo('verano');
            foreach ($permisos as $permiso)
                $em->remove($permiso);
        }
        if ($id == 'baja'){
            $permisos = $this->getDoctrine()->getRepository('miomioBundle:Permiso')->findByTipo('baja');
            foreach ($permisos as $permiso)
                $em->remove($permiso);
        }
        if ($id != 'baja' && $id != 'verano' && $id != 'invierno'){
            $permiso = $this->getDoctrine()->getRepository('miomioBundle:Permiso')->find($id);
            $em->remove($permiso);
        }
        $em->flush();
    }

    public function listarpermisosAction($id)
    {
        $return_arr = array();

        if ($id == 0)
             $permisos = $this->getDoctrine()->getRepository('miomioBundle:Permiso')->findAll();
        else
            $permisos = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->find($id)->getPermisos();

        foreach($permisos as $permiso){
                    $array['dni'] = $permiso->getEmpleado()->getDni();
                    $array['username'] = $permiso->getEmpleado()->getUsername();
                    $array['nombre'] = $permiso->getEmpleado()->getNombre();
                    $array['apellido1'] = $permiso->getEmpleado()->getApellido1();
                    $array['tipo'] = $permiso->getTipo();
                    $array['realizada'] = $permiso->getFecha()->format('d/m/Y H:i:s');
                    $array['inicio'] = $permiso->getInicio()->format('d/m/Y');
                    $array['fin'] = $permiso->getFin()->format('d/m/Y');
                array_push($return_arr,$array);
         }
         
   return new Response ('{"iTotalRecords": "' .count($permisos). '","iTotalDisplayRecords": "' .count($permisos). '","aaData": '.json_encode($return_arr).'}');
    }

}
