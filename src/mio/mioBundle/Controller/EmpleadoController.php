<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Pedido;
use mio\mioBundle\Entity\Permiso;
use mio\mioBundle\Entity\Lineaspedido;
use mio\mioBundle\Form\EmpleadoType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * Empleado controller.
 *
 * @Route("/empleado")
 */
class EmpleadoController extends Controller
{
    /**
     * Lists all Empleado entities.
     *
     * @Route("/", name="empleado")
     * @Template()
     */
    public function listarempleadosAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('miomioBundle:Empleado')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Empleado entity.
     *
     * @Route("/{id}/show", name="empleado_show")
     * @Template()
     */
    public function verempleadoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Empleado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EmpleadoType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Empleado entity.
     *
     * @Route("/new", name="empleado_new")
     * @Template()
     */
    public function crearempleadoAction()
    {
        $entity = new Empleado();
        $form   = $this->createForm(new EmpleadoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Empleado entity.
     *
     * @Route("/create", name="empleado_create")
     * @Method("post")
     * @Template("miomioBundle:Empleado:crearempleado.html.twig")
     */
    public function createAction()
    {
        $entity  = new Empleado();
        $request = $this->getRequest();
        $form    = $this->createForm(new EmpleadoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
			$em = $this->getDoctrine()->getEntityManager(); 
        $entity->setFechaAlta(new \DateTime());
       	$entity->setSalt(md5(time()));
       	$psswd = substr( md5(microtime()), 1, 8);
        $role = $em->getRepository('miomioBundle:Role')->find(2);
        $entity->setRole($role);
       	$em->persist($entity);
       	
			$message = \Swift_Message::newInstance()
      	  ->setSubject("Nuevo empleado")
       	  ->setFrom('paradasymfony@alwaysdata.com')
       	  ->setTo($entity->getEmail())
       	  ->setBody('Hola '.$entity->getNombre().' '.$entity->getApellido1().' '.$entity->getApellido2().'.<br/><br/>'.
       	  				'Se ha dado de alta en el sistema Optinet.Le adjunto los datos para que usted pueda entrar al sistema:<br/>'.
       	  				'Nombre usuario:  '.$entity->getUsername().'<br/>'.
       	  				'Contraseña:     '.$psswd.'<br/><br/>'.
       	  				'Un saludo.'
       	  				,'text/html');
    		$this->get('mailer')->send($message);
                       
            $encoder = new MessageDigestPasswordEncoder('sha1');
            $password = $encoder->encodePassword($psswd, $entity->getSalt());
            $entity->setPassword($password);
            // a partir de aqui, para poder hacer el passolvidado.
            $claveusuario="";
            $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            /* Introduce la semilla del generador de números aleatorios mejorado */
            mt_srand(microtime() * 1000000); 
            for($i = 0; $i < 20; $i++)
            {
              /* Genera un valor aleatorio mejorado con mt_rand, entre 0 y el tamaño del array $caracteres menos 1. Posteríormente vamos concatenando en la cadena $password
              los caracteres que se van eligiendo aleatoriamente.*/
              $caracter = mt_rand(0,strlen($caracteres)-1);
              $claveusuario = $claveusuario . $caracteres{$caracter};
            }
            $entity->setClaveusuario($claveusuario);
            $em->persist($entity);
            $em->flush();

            $t = $this->get('translator')->trans(
                'El empleado %nombre% ha sido creado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            return $this->redirect($this->generateUrl('empleado'));
            
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorempleado',$t);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Empleado entity.
     *
     * @Route("/{id}/edit", name="empleado_edit")
     * @Template()
     */
    public function modificarempleadoAction($id){

        if ($id != $this->container->get('security.context')->getToken()->getUser()->getId())
            if ( false === $this->get('security.context')->isGranted('ROLE_A'))
                throw new AccessDeniedException();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Empleado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
        }

        $editForm = $this->createForm(new EmpleadoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Empleado entity.
     *
     * @Route("/{id}/update", name="empleado_update")
     * @Method("post")
     * @Template("miomioBundle:Empleado:modificarempleado.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Empleado')->find($id);
        $pass = $entity->getPassword();
        $salt = $entity->getSalt();
        $encoder = new MessageDigestPasswordEncoder('sha1');

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
        }

        $editForm   = $this->createForm(new EmpleadoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->get('generar')->getData() == true){

                $salt1 = md5(time());
                $psswd = substr( md5(microtime()), 1, 8);

                $message = \Swift_Message::newInstance()
              ->setSubject("Nueva contraseña generada")
              ->setFrom('paradasymfony@alwaysdata.com')
              ->setTo($entity->getEmail())
              ->setBody('Hola '.$entity->getNombre().' '.$entity->getApellido1().' '.$entity->getApellido2().'.<br/><br/>'.
                            'Se ha generado una nueva contraseña en el sistema Optinet.Le adjunto los datos para que usted pueda entrar al sistema:<br/>'.
                            'Nombre usuario:  '.$entity->getUsername().'<br/>'.
                            'Contraseña:     '.$psswd.'<br/><br/>'.
                            'Un saludo.'
                            ,'text/html');
                $this->get('mailer')->send($message);

                $password = $encoder->encodePassword($psswd, $salt1);

               if ($editForm->isValid()) {
                $em->persist($entity);
                $entity->setPassword($password);
                $entity->setSalt($salt1);
                $em->persist($entity);
                $em->flush();
                 $t = $this->get('translator')->trans(
                    'El empleado %nombre% ha sido modificado correctamente.',
                    array('%nombre%' => $entity->getNombre())
                );
                $this->get('session')->setFlash('confirmacion',$t);
                return $this->redirect($this->generateUrl('empleado_edit', array('id' => $id)));
            }
            $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
            $this->get('session')->setFlash('errorempleado',$t);

            return array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        }
        else{
            $salt1 = md5(time());
            $password = $encoder->encodePassword($editForm->get('password')->getData(), $salt1);
            $entity->setPassword($password);
            $entity->setSalt($salt1);

            if ($editForm->isValid()) {
               if ($editForm->get('password')->getData() == ''){ 
                    $entity->setPassword($pass);
                    $entity->setSalt($salt);
                }
                $em->persist($entity);
                $em->flush();
                 $t = $this->get('translator')->trans(
                    'El empleado %nombre% ha sido modificado correctamente.',
                    array('%nombre%' => $entity->getNombre())
                );
                $this->get('session')->setFlash('confirmacion',$t);
                return $this->redirect($this->generateUrl('empleado_edit', array('id' => $id)));
            }
            $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
            $this->get('session')->setFlash('errorempleado',$t);

            return array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        }
    }

    public function eliminarempleadoAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('miomioBundle:Empleado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Empleado entity.');
            }
            $t = $this->get('translator')->trans(
                'El empleado %nombre% ha sido eliminado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('empleado'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    public function gestionpermisosAction()
    {
      $empleados = $this->getDoctrine()->getRepository('miomioBundle:Empleado')->findAll();
      return ($this->render('miomioBundle:Empleado:gestionpermisos.html.twig',array('empleados' => $empleados))); 
    }

    public function pedidoAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $proveedor = $this->getDoctrine()->getRepository('miomioBundle:Proveedor')->find($id);
        $productos = $proveedor->getProductos();
        return $this->render('miomioBundle:Empleado:pedido.html.twig',array('productos' => $productos,'proveedor' => $proveedor));
    }
}
