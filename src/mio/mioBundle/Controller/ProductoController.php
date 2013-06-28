<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use mio\mioBundle\Entity\Producto;
use mio\mioBundle\Entity\Familia;
use mio\mioBundle\Entity\Reserva;
use mio\mioBundle\Entity\Lineasoperacion;
use mio\mioBundle\Form\ProductoType;
use mio\mioBundle\Form\ProductoShowType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Producto controller.
 *
 * @Route("/producto")
 */
class ProductoController extends Controller
{
    public function ajaxproductos2Action($idproveedor)
    {
        $return_arr = array();
        $contar = 0;
        $unidades = "unidad/es";
        $t = $this->get('translator')->trans($unidades);
        $proveedor = $this->getDoctrine()->getRepository('miomioBundle:Proveedor')->find($idproveedor);
        $productos = $proveedor->getProductos();
            foreach ($productos as $producto){
                if ($producto->getReservado() > 0){
                    $row_array['id'] = $producto->getId();
                    $reservas = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->findByApartado('no');
                    foreach ($reservas as $reserva)
                        if (!$reserva->getAvisada())
                        foreach ($reserva->getLineas() as $linea)
                            if ($linea->getProducto()->getReservado() > 0)
                                if ($producto->getId() == $linea->getProducto()->getId()){
                                    $row_array['clienteid'] = $reserva->getCliente()->getId();
                                    $row_array['cliente'] = ucwords($reserva->getCliente()->getNombre()) .' ' .$reserva->getCliente()->getApellido1();
                                    $row_array['reserva'] = $reserva->getId();                                    
                                    $row_array['descripcion'] = $producto->getDescripcion();
                                    $row_array['iva'] = $linea->getIva(). ' %';
                                    $row_array['preciocompra'] = $linea->getPcompra() . ' €';
                                    $row_array['precioventa'] = $linea->getPrecio() . ' €';
                                    $row_array['stock'] = $producto->getStock() . ' ' . $t;
                                    $row_array['apartado'] = $producto->getApartado() . ' ' . $t;
                                    $row_array['reservado'] = $linea->getCantidad() . ' ' . $t;
                                    array_push($return_arr,$row_array);
                                    $contar++;
                }
            }
        }
        return new Response ('{"iTotalRecords": "' . $contar . '","iTotalDisplayRecords": "' . $contar. '","aaData": '.json_encode($return_arr).'}');
    }

    public function ajaxproductos1Action($idproveedor)
    {
        $return_arr = array();
        $unidades = "unidad/es";
        $t = $this->get('translator')->trans($unidades);
        $proveedor = $this->getDoctrine()->getRepository('miomioBundle:Proveedor')->find($idproveedor);
        $productos = $proveedor->getProductos();
            foreach ($productos as $producto){

                $row_array['id'] = $producto->getId();
                $row_array['descripcion'] = $producto->getDescripcion();
                $row_array['iva'] = $producto->getIva(). ' %';
                $row_array['preciocompra'] = $producto->getPcompra() . ' €';
                $row_array['precioventa'] = $producto->getPventa() . ' €';
                $row_array['stock'] = $producto->getStock() . ' ' . $t;
                $row_array['apartado'] = $producto->getApartado() . ' ' . $t;
                $row_array['reservado'] = $producto->getReservado() . ' ' . $t;
                array_push($return_arr,$row_array); 
        }
        return new Response ('{"iTotalRecords": "' .count($productos). '","iTotalDisplayRecords": "' .count($productos). '","aaData": '.json_encode($return_arr).'}');
    }

    public function ajaxproductosAction($idfamilia)
    {
        $return_arr = array();
        $unidades = "unidad/es";
        $t = $this->get('translator')->trans($unidades);
        if ($idfamilia == 0)
                $productos = $this->getDoctrine()->getRepository('miomioBundle:Producto')->findBy(array('familia' => null));
        else{
                $familia = $this->getDoctrine()->getRepository('miomioBundle:Familia')->find($idfamilia);
                $productos = $familia->getProductosfamilia();
            }
            foreach ($productos as $producto){

                $row_array['id'] = $producto->getId();
                $row_array['descripcion'] = $producto->getDescripcion();
                $row_array['iva'] = $producto->getIva(). ' %';
                $row_array['preciocompra'] = $producto->getPcompra() . ' €';
                $row_array['precioventa'] = $producto->getPventa() . ' €';
                $row_array['stock'] = $producto->getStock() . ' ' . $t;
                $row_array['apartado'] = $producto->getApartado() . ' ' . $t;
                $row_array['reservado'] = $producto->getReservado() . ' ' . $t;
                array_push($return_arr,$row_array); 
        }
        return new Response ('{"iTotalRecords": "' .count($productos). '","iTotalDisplayRecords": "' .count($productos). '","aaData": '.json_encode($return_arr).'}');
    }

    /**
     * Lists all Producto entities.
     *
     * @Route("/", name="producto")
     * @Template()
     */
    public function listarproductosAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('miomioBundle:Producto')->findAll();
        $familias = $em->getRepository('miomioBundle:Familia')->findAll();
        return array('entities' => $entities,'familias' => $familias);
    }

    /**
     * Finds and displays a Producto entity.
     *
     * @Route("/{id}/show", name="producto_show")
     * @Template()
     */
    public function verproductoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Producto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProductoType(), $entity);

        return array(
            'entity'      => $entity,
			'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Producto entity.
     *
     * @Route("/new", name="producto_new")
     * @Template()
     */
    public function crearproductoAction()
    {
        $entity = new Producto();
        $form   = $this->createForm(new ProductoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Producto entity.
     *
     * @Route("/create", name="producto_create")
     * @Method("post")
     * @Template("miomioBundle:Producto:crearproducto.html.twig")
     */
    public function createAction()
    {
        $entity  = new Producto();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProductoType(), $entity);
        $form->bindRequest($request);
			
        if ($form->isValid()) {
        	$entity->setReservado(0);
            $entity->setApartado(0);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $t = $this->get('translator')->trans(
                'El producto %descripcion% ha sido creado correctamente.',
                array('%descripcion%' => $entity->getDescripcion())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            return $this->redirect($this->generateUrl('producto'));
            
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorproducto',$t);
        
        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Producto entity.
     *
     * @Route("/{id}/edit", name="producto_edit")
     * @Template()
     */
    public function modificarproductoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Producto entity.');
        }

        $editForm = $this->createForm(new ProductoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Producto entity.
     *
     * @Route("/{id}/update", name="producto_update")
     * @Method("post")
     * @Template("miomioBundle:Producto:modificarproducto.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Producto entity.');
        }

        $editForm   = $this->createForm(new ProductoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $t = $this->get('translator')->trans(
                'El producto %descripcion% ha sido modificado correctamente.',
                array('%descripcion%' => $entity->getDescripcion())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            //return $this->redirect($this->generateUrl('producto_edit', array('id' => $id)));
             return $this->redirect($this->generateUrl('producto'));

        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorproducto',$t);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Producto entity.
     *
     * @Route("/{id}/delete", name="producto_delete")
     * @Method("post")
     */
    public function eliminarproductoAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('miomioBundle:Producto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Producto entity.');
            }
            $t = $this->get('translator')->trans(
                'El producto %descripcion% ha sido eliminado correctamente.',
                array('%descripcion%' => $entity->getDescripcion())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('producto'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
