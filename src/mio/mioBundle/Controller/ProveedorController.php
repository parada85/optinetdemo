<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use mio\mioBundle\Entity\Proveedor;
use mio\mioBundle\Form\ProveedorType;

/**
 * Proveedor controller.
 *
 * @Route("/proveedor")
 */
class ProveedorController extends Controller
{
    /**
     * Lists all Proveedor entities.
     *
     * @Route("/", name="proveedor")
     * @Template()
     */
    public function listarproveedoresAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('miomioBundle:Proveedor')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Proveedor entity.
     *
     * @Route("/{id}/show", name="proveedor_show")
     * @Template()
     */
    public function verproveedorAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }
        $editForm = $this->createForm(new ProveedorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Proveedor entity.
     *
     * @Route("/new", name="proveedor_new")
     * @Template()
     */
    public function crearproveedorAction()
    {
        $entity = new Proveedor();
        $form   = $this->createForm(new ProveedorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Proveedor entity.
     *
     * @Route("/create", name="proveedor_create")
     * @Method("post")
     * @Template("miomioBundle:Proveedor:crearproveedor.html.twig")
     */
    public function createAction()
    {
        $entity  = new Proveedor();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProveedorType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $t = $this->get('translator')->trans(
                'El proveedor %nombre% ha sido creado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            return $this->redirect($this->generateUrl('proveedor'));
            
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorproveedor',$t);
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Proveedor entity.
     *
     * @Route("/{id}/edit", name="proveedor_edit")
     * @Template()
     */
    public function modificarproveedorAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm = $this->createForm(new ProveedorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Proveedor entity.
     *
     * @Route("/{id}/update", name="proveedor_update")
     * @Method("post")
     * @Template("miomioBundle:Proveedor:modificarproveedor.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm   = $this->createForm(new ProveedorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $t = $this->get('translator')->trans(
                'El proveedor %nombre% ha sido modificado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            //return $this->redirect($this->generateUrl('proveedor_edit', array('id' => $id)));
             return $this->redirect($this->generateUrl('proveedor'));
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorproveedor',$t);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Proveedor entity.
     *
     * @Route("/{id}/delete", name="proveedor_delete")
     * @Method("post")
     */
    public function eliminarproveedorAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('miomioBundle:Proveedor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Proveedor entity.');
            }
            $t = $this->get('translator')->trans(
                'El proveedor %nombre% ha sido eliminado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proveedor'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
