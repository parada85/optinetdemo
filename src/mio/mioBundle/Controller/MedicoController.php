<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use mio\mioBundle\Entity\Medico;
use mio\mioBundle\Form\MedicoType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * Medico controller.
 *
 * @Route("/medico")
 */
class MedicoController extends Controller
{
    /**
     * Lists all Medico entities.
     *
     * @Route("/", name="medico")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('miomioBundle:Medico')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Medico entity.
     *
     * @Route("/{id}/show", name="medico_show")
     * @Template()
     */
    public function vermedicoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Medico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MedicoType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Medico entity.
     *
     * @Route("/new", name="medico_new")
     * @Template()
     */
    public function crearmedicoAction()
    {
        $entity = new Medico();
        $form   = $this->createForm(new MedicoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Medico entity.
     *
     * @Route("/create", name="medico_create")
     * @Method("post")
     * @Template("miomioBundle:Medico:crearmedico.html.twig")
     */
    public function createAction()
    {
        $entity  = new Medico();
        $request = $this->getRequest();
        $form    = $this->createForm(new MedicoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
        $em = $this->getDoctrine()->getEntityManager(); 
        $entity->setFechaAlta(new \DateTime());
        $entity->setSalt(md5(time()));
        $psswd = substr( md5(microtime()), 1, 8);
        $role = $em->getRepository('miomioBundle:Role')->find(3);
        $entity->setRole($role);
        $em->persist($entity);
            $message = \Swift_Message::newInstance()
          ->setSubject("Nuevo empleado (médico)")
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
                'El médico %nombre% ha sido creado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            return $this->redirect($this->generateUrl('empleado'));
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errormedico',$t);
          return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Medico entity.
     *
     * @Route("/{id}/edit", name="medico_edit")
     * @Template()
     */
    public function modificarmedicoAction($id)
    {
           if ($id != $this->container->get('security.context')->getToken()->getUser()->getId())
            if ( false === $this->get('security.context')->isGranted('ROLE_A'))
                throw new AccessDeniedException();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Medico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
        }

        $editForm = $this->createForm(new MedicoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Medico entity.
     *
     * @Route("/{id}/update", name="medico_update")
     * @Method("post")
     * @Template("miomioBundle:Medico:modificarmedico.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Medico')->find($id);
        $pass = $entity->getPassword();
        $salt = $entity->getSalt();
        $encoder = new MessageDigestPasswordEncoder('sha1');

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medico entity.');
        }

        $editForm   = $this->createForm(new MedicoType(), $entity);
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
                    'El médico %nombre% ha sido modificado correctamente.',
                    array('%nombre%' => $entity->getNombre())
                );
                $this->get('session')->setFlash('confirmacion',$t);
                return $this->redirect($this->generateUrl('medico_edit', array('id' => $id)));
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
                    'El médico %nombre% ha sido modificado correctamente.',
                    array('%nombre%' => $entity->getNombre())
                );
                $this->get('session')->setFlash('confirmacion',$t);
                return $this->redirect($this->generateUrl('medico_edit', array('id' => $id)));
            }
            $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
            $this->get('session')->setFlash('errormedico',$t);

            return array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        }
    }

    /**
     * Deletes a Medico entity.
     *
     * @Route("/{id}/delete", name="medico_delete")
     * @Method("post")
     */
    public function eliminarmedicoAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('miomioBundle:Medico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Medico entity.');
            }
            $t = $this->get('translator')->trans(
            'El médico %nombre% ha sido eliminado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('medico'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
