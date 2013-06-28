<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use mio\mioBundle\Entity\Familia;
use mio\mioBundle\Form\FamiliaType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Familia controller.
 *
 * @Route("/familia")
 */
class FamiliaController extends Controller
{
	
	
	  public function moverfamiliaAction()
    {
    		
    	$em = $this->getDoctrine()->getEntityManager();
        $familias = $em->getRepository('miomioBundle:Familia')->findAll();
        return $this->render('miomioBundle:Familia:moverfamilia.html.twig',array('familias'=> $familias));
    }

        public function moverfamiliaajaxAction($id)
    {

        $return_arr = array();
        $em = $this->getDoctrine()->getEntityManager();

        if ($id == 0)
            $productos = $em->getRepository('miomioBundle:Producto')->findBy(array('familia' => null));
        else{
            $familia = $em->getRepository('miomioBundle:Familia')->find($id);
            $productos = $familia->getProductosfamilia();
        }
        foreach ($productos as $producto){
            $array['id'] = $producto->getId(); 
            $array['descripcion'] = $producto->getDescripcion();
        array_push($return_arr,$array);
        }
        
    return  new Response(json_encode($return_arr), 200, array('Content-Type', 'text/json'));
    }

     public function moverfamiliaajax1Action()
    {

        $id_producto = $this->getRequest()->query->get('id_producto');
        $id_familia = $this->getRequest()->query->get('id_familia');

        $return_arr = array();
        $em = $this->getDoctrine()->getEntityManager();
        $producto = $em->getRepository('miomioBundle:Producto')->find($id_producto);
        $familia = new Familia();

        if ($id_familia == 0){
            $producto->setFamilia(null);
        }
        else{
            $familia = $em->getRepository('miomioBundle:Familia')->find($id_familia);
            $producto->setFamilia($familia);
        }
        $em->persist($producto);
        $em->flush();
        return  new Response();
    }
    /**
     * Lists all Familia entities.
     *
     * @Route("/", name="familia")
     * @Template()
     */
    public function listarfamiliasAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('miomioBundle:Familia')->findAll();
        $productos = $em->getRepository('miomioBundle:Producto')->findBy(array('familia' => null));
        $contador = count($productos);

        return array('entities' => $entities,'contador' => $contador);
    }

    /**
     * Finds and displays a Familia entity.
     *
     * @Route("/{id}/show", name="familia_show")
     * @Template()
     */
    public function verfamiliaAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Familia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Familia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FamiliaType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Familia entity.
     *
     * @Route("/new", name="familia_new")
     * @Template()
     */
    public function crearfamiliaAction()
    {
        $entity = new Familia();
        $form   = $this->createForm(new FamiliaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Familia entity.
     *
     * @Route("/create", name="familia_create")
     * @Method("post")
     * @Template("miomioBundle:Familia:crearfamilia.html.twig")
     */
    public function createAction()
    {
        $entity  = new Familia();
        $request = $this->getRequest();
        $form    = $this->createForm(new FamiliaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $t = $this->get('translator')->trans(
                'La familia %nombre% ha sido creada correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            return $this->redirect($this->generateUrl('familia'));
            
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('error',$t);
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Familia entity.
     *
     * @Route("/{id}/edit", name="familia_edit")
     * @Template()
     */
    public function modificarfamiliaAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Familia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Familia entity.');
        }

        $editForm = $this->createForm(new FamiliaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Familia entity.
     *
     * @Route("/{id}/update", name="familia_update")
     * @Method("post")
     * @Template("miomioBundle:Familia:modificarfamilia.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Familia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Familia entity.');
        }

        $editForm   = $this->createForm(new FamiliaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $t = $this->get('translator')->trans(
                'La familia %nombre% ha sido modificada correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            //return $this->redirect($this->generateUrl('familia_edit', array('id' => $id)));
            return $this->redirect($this->generateUrl('familia'));
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('error',$t);
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Familia entity.
     *
     * @Route("/{id}/delete", name="familia_delete")
     * @Method("post")
     */
    public function eliminarfamiliaAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('miomioBundle:Familia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Familia entity.');
            }
            $t = $this->get('translator')->trans(
                'La familia %nombre% ha sido eliminada correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('familia'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
