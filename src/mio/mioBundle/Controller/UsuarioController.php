<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

use Ps\PdfBundle\Annotation\Pdf;

use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Pedido;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Devolucion;
use mio\mioBundle\Entity\Reserva;
use mio\mioBundle\Entity\Lineasoperacion;
use mio\mioBundle\Entity\Lineaspedido;
use mio\mioBundle\Entity\Producto;
use mio\mioBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
	
	public function ventaAction($id)
	{
		$em = $this->get('doctrine')->getEntityManager();
		$productos = $em->getRepository('miomioBundle:Producto')->listaproducto();
		$user = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->find($id);
	 	return $this->render('miomioBundle:Usuarios:venta.html.twig',array('productos' => $productos,'identificador' => $id,'user'=>$user));
	
	}
	public function reservaAction($id)
	{
		$em = $this->get('doctrine')->getEntityManager();
		$productos = $em->getRepository('miomioBundle:Producto')->listaproducto();
		$user = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->find($id);
	 	return $this->render('miomioBundle:Usuarios:reserva.html.twig',array('productos' => $productos,'identificador' => $id,'user'=>$user));
	
	}
    public function apartadoAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $productos = $em->getRepository('miomioBundle:Producto')->listaproducto();
        $user = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->find($id);
        return $this->render('miomioBundle:Usuarios:apartado.html.twig',array('productos' => $productos,'identificador' => $id,'user'=>$user));
    
    }
	
	public function devolucionAction($id)
	{
		$lineasdevolucion = new ArrayCollection();
		$em = $this->get('doctrine')->getEntityManager();
		$venta = $this->getDoctrine()->getRepository('miomioBundle:Venta')->find($id);
		$empleado = $venta->getEmpleado();
		$cliente = $venta->getCliente();
		$lineasventa = $venta->getLineas();
		$devoluciones = $venta->getDevoluciones();
	 	return $this->render('miomioBundle:Usuarios:devolucion.html.twig',array('lineasventa' => $lineasventa,'empleado' => $empleado,'cliente'=>$cliente, 'venta'=>$venta, 'devoluciones'=>$devoluciones));
	}

	public function ventauAction()
	{
		$em = $this->get('doctrine')->getEntityManager();
		$venta=new Venta();
	    $venta->setFechaoper(new \DateTime('now'));
        $productos = $this->getRequest()->query->get('productos');
		$count = count($productos);
        $clienteid = $this->getRequest()->query->get('cliente');
        $formapago = $this->getRequest()->query->get('formapago');
        $totalpago = $this->getRequest()->query->get('totalpago');
		$cliente = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->find($clienteid);
		$empleado = $this->get('security.context')->getToken()->getUser();
		$venta->setEmpleado($empleado);

		$cliente->addOperacion($venta);//asociacion de usuario a operacion (add porque es una coleccion)
		$venta->setCliente($cliente);//asociacion de operacion a cliente.
		$total=0;
		//$venta->setTotal($total);
        $venta->setPago($formapago);
        $venta->setTotalPago($totalpago);
		$em->persist($cliente);

        for ($i = 0; $i < $count; $i=$i+2) {
            $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
            $total += $producto->getPventa() * $productos[$i+1];
        }
        $venta->setTotal($total);
		$em->persist($venta);
    	$em->flush();
        
        for ($i = 0; $i < $count; $i=$i+2) {
    		 $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
    		 $cantidad = $productos[$i+1];
    		 $loper = new Lineasoperacion();
    		 $loper->setOperacion($venta);//asociacion de lineaoperacion a operacion
    		 $loper->setProducto($producto);
    		 $loper->setPrecio($producto->getPventa());
             $loper->setIva($producto->getIva());
             $loper->setPcompra($producto->getPcompra());
    		 $loper->setCantidad($cantidad);
    		 $venta->addLineasoperacion($loper);//añado el producto con la cantidad a la venta.
    		 $em->persist($loper);
    		 $producto->setStock($producto->getStock()-$cantidad);
    	}
    	
    	$em->flush();
        $t = $this->get('translator')->trans(
                'La venta %nombre% ha sido creada correctamente.',
                array('%nombre%' => $venta->getId())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            
        return new Response ($venta->getId());//para poder realizar la factura
    }


    public function devolucionuAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $devolucion = new Devolucion();
        $devolucion->setFechaoper(new \DateTime('now'));

        $clienteid = $this->getRequest()->query->get('cliente');
        $cliente = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->find($clienteid);
        $ventaid = $this->getRequest()->query->get('venta');
        $descripcion = $this->getRequest()->query->get('descripcion');
        $productos = $this->getRequest()->query->get('productos');
        $count = count($productos);
        $venta = $this->getDoctrine()->getRepository('miomioBundle:Venta')->find($ventaid);
        
        $empleado = $this->get('security.context')->getToken()->getUser();
        $devolucion->setEmpleado($empleado);

        $cliente->addOperacion($devolucion);//asociacion de usuario a operacion (add porque es una coleccion)
        $devolucion->setCliente($cliente);//asociacion de operacion a cliente.
        $total=0;
        $devolucion->setDescripcion($descripcion);
        $devolucion->setVenta($venta);

        for ($i = 0; $i < $count; $i=$i+3) {
            $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
            $total += $producto->getPventa() * $productos[$i+1];
        }
        $devolucion->setTotal($total);
        $em->persist($cliente);
        $em->persist($devolucion);
        $em->flush();

        for($i = 0;$i < $count;$i = $i+3){
             $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
             $cantidad = $productos[$i+1];
             $loper = new Lineasoperacion();
             $loper->setOperacion($devolucion);//asociacion de lineaoperacion a operacion
             $loper->setProducto($producto);
             $loper->setPrecio($producto->getPventa());
             $loper->setIva($producto->getIva());
             $loper->setPcompra($producto->getPcompra());
             $loper->setCantidad($cantidad);
             $loper->setEstado($productos[$i+2]);
             $devolucion->addLineasoperacion($loper);//añado el producto con la cantidad a la devolucion.
             if ($productos[$i+2] == 'bueno')
                $producto->setStock($producto->getStock() + $cantidad);
             $em->persist($loper);
        }

        $em->flush();
        $t = $this->get('translator')->trans(
                'La devolución %nombre% ha sido creada correctamente.',
                array('%nombre%' => $devolucion->getId())
            );
            $this->get('session')->setFlash('confirmacion',$t);
        return new Response($devolucion->getId());//para poder realizar el documento
    }
	
		public function reservauAction()
	{
		$em = $this->get('doctrine')->getEntityManager();
		$reserva = new Reserva();
	    $reserva->setFechaoper(new \DateTime('now'));
        $clienteid = $this->getRequest()->query->get('cliente');
        $productos = $this->getRequest()->query->get('productos');
        $count = count($productos);
        $adelanto = $this->getRequest()->query->get('adelanto');
        $formapago = $this->getRequest()->query->get('formapago');
        $totalpago = $this->getRequest()->query->get('totalpago');
		$cliente = $this->getDoctrine()->getRepository('miomioBundle:Usuario')->find($clienteid);

		$cliente->addOperacion($reserva);//asociacion de usuario a operacion (add porque es una coleccion)
		$reserva->setCliente($cliente);//asociacion de operacion a cliente.
		$total=0;
        $apartado = $this->getRequest()->query->get('apartado');
        if ($apartado == 'si') $reserva->setApartado($apartado);
        else $reserva->setApartado('no');
        for ($i = 0; $i < $count; $i=$i+2) {
            $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
            $total += $producto->getPventa() * $productos[$i+1];
        }
        $reserva->setTotal($total);
    	$reserva->setAdelanto($adelanto);
		$empleado = $this->get('security.context')->getToken()->getUser();
		$reserva->setEmpleado($empleado);
        $reserva->setPago($formapago);
        $reserva->setTotalPago($totalpago);
		
		$em->persist($cliente);
		$em->persist($reserva);
    	$em->flush();

    	for( $i=0 ; $i < $count ; $i=$i+2){
    		 $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
    		 $cantidad = $productos[$i+1];
    		 $loper = new Lineasoperacion();
    		 $loper->setOperacion($reserva);//asociacion de lineaoperacion a operacion
    		 $loper->setProducto($producto);
    		 $loper->setCantidad($cantidad);
    		 $loper->setPrecio($producto->getPventa());
             $loper->setIva($producto->getIva());
             $loper->setPcompra($producto->getPcompra());
    		 $reserva->addLineasoperacion($loper);//añado el producto con la cantidad a la reserva.
    		 $em->persist($loper);
    		 $em->flush();
             if ($apartado == 'no')
    		      $producto->setReservado($producto->getReservado() + $cantidad);
             else{
                  $producto->setApartado($producto->getApartado() + $cantidad);
                  $producto->setStock($producto->getStock() - $cantidad);
              }
    	}
    	$em->persist($reserva);
    	$em->flush();

        if ($apartado=='no')
            $t = $this->get('translator')->trans('La reserva %nombre% ha sido creada correctamente.',array('%nombre%' => $reserva->getId()));
        else
            $t = $this->get('translator')->trans('El apartado %nombre% ha sido creado correctamente.',array('%nombre%' => $reserva->getId()));

        $this->get('session')->setFlash('confirmacion',$t);

		return new Response ($reserva->getId());//para poder realizar el pdf
	}

    public function convertiruAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $venta = new Venta();
        $venta->setFechaoper(new \DateTime('now'));
        $reservaid = $this->getRequest()->query->get('reserva');
        $formapago = $this->getRequest()->query->get('formapago');
        $totalpago = $this->getRequest()->query->get('totalpago');
        $reserva = $this->getDoctrine()->getRepository('miomioBundle:Reserva')->find($reservaid);
        $cliente = $reserva->getCliente();
        $empleado = $this->get('security.context')->getToken()->getUser();
        $venta->setEmpleado($empleado);

        $cliente->addOperacion($venta);//asociacion de usuario a operacion (add porque es una coleccion)
        $venta->setCliente($cliente);//asociacion de operacion a cliente.
        $total=0;
        $venta->setPago($formapago);
        $venta->setTotalpago($totalpago);
        $em->persist($cliente);
        $lineas = $reserva->getLineas();

         foreach ($lineas as $linea){
            $total += $linea->getProducto()->getPventa() * $linea->getCantidad();
         }

         if (abs($total-$reserva->getAdelanto()) < 0.001) 
            $total = 0;
        else
            $total = $total - $reserva->getAdelanto();

        $venta->setTotal($total);
        $em->persist($venta);
        $em->flush();

        foreach ($lineas as $linea){
            $loper = new Lineasoperacion();
            $loper->setOperacion($venta);//asociacion de lineaoperacion a operacion
            $loper->setProducto($linea->getProducto());
            $loper->setPrecio($linea->getProducto()->getPventa());
            $loper->setIva($linea->getProducto()->getIva());
            $loper->setPcompra($linea->getProducto()->getPcompra());
            $loper->setCantidad($linea->getCantidad());
            $em->persist($loper);
            $venta->addLineasoperacion($loper);//añado el producto con la cantidad a la venta.
            if ($reserva->getApartado() == 'no' and $reserva->getAvisada() == null){
                $producto = $linea->getProducto();
                $producto->setStock($producto->getStock() - $linea->getCantidad());
                $producto->setReservado($producto->getReservado() - $linea->getCantidad());
                $em->persist($producto);
            }
            else{
                $producto = $linea->getProducto();
                $producto->setApartado($producto->getApartado() - $linea->getCantidad());
                $em->persist($producto);
            }
        }
        $venta->setTotal($total);
        $em->persist($venta);
        $em->flush();
        $reserva->setVenta($venta);
        $em->persist($reserva);
        $em->flush();
        $t = $this->get('translator')->trans(
                'La venta %nombre% ha sido creada correctamente.',
                array('%nombre%' => $venta->getId())
            );
            $this->get('session')->setFlash('confirmacion',$t);
            
        return new Response ($venta->getId());//para poder realizar la factura
    }
    
    public function pedidouAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        
        $proveedor_id = $this->getRequest()->query->get('proveedor');
        $productos = $this->getRequest()->query->get('productos');
        $count = count($productos);

        $pedido=new Pedido();
        $pedido->setFecha(new \DateTime('now'));
        $total=0;
        $proveedor = $this->getDoctrine()->getRepository('miomioBundle:Proveedor')->find($proveedor_id);
        $empleado = $this->get('security.context')->getToken()->getUser();
        $pedido->setEmpleado($empleado);
        $pedido->setProveedor($proveedor);

        for ($i = 0; $i < $count; $i=$i+2) {
            $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
            $total += $producto->getPcompra() * $productos[$i+1];
        }
        $pedido->setTotal($total);
        $em->persist($pedido);
        $em->flush();

        for($i = 0 ; $i < $count ; $i = $i+2){
             $producto = $this->getDoctrine()->getRepository('miomioBundle:Producto')->find($productos[$i]);
             $cantidad = $productos[$i+1];
             $lpedido = new Lineaspedido();
             $lpedido->setPedido($pedido);
             $lpedido->setProducto($producto);
             $lpedido->setPrecio($producto->getPcompra());
             $lpedido->setIva($producto->getIva());
             $lpedido->setCantidad($cantidad);
             $em->persist($lpedido);
             $pedido->addLineasPedido($lpedido);//asociacion de pedido a lineapedido
        }
        $em->flush();
         $t = $this->get('translator')->trans(
                'El pedido %nombre% ha sido creado correctamente.',
                array('%nombre%' => $pedido->getId())
            );
            $this->get('session')->setFlash('confirmacion',$t);
        return new Response();
    }

    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="usuario")
     * @Template()
     */
    public function listarclientesAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('miomioBundle:Usuario')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}/show", name="usuario_show")
     * @Template()
     */
    public function verclienteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }
		  $editForm = $this->createForm(new UsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }
    /**
     * Displays a form to create a new Usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Template()
     */
    public function crearclienteAction()
    {
        $entity = new Usuario();
        $form   = $this->createForm(new UsuarioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/create", name="usuario_create")
     * @Method("post")
     * @Template("miomioBundle:Usuario:crearcliente.html.twig")
     */
    public function createAction()
    {
        $entity  = new Usuario();
        $request = $this->getRequest();
        $form    = $this->createForm(new UsuarioType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            $t = $this->get('translator')->trans(
                'El cliente %nombre% ha sido creado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            return $this->redirect($this->generateUrl('usuario'));
            
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorusuario',$t);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Template()
     */
    public function modificarclienteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createForm(new UsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}/update", name="usuario_update")
     * @Method("post")
     * @Template("miomioBundle:Usuario:modificarcliente.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm   = $this->createForm(new UsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $t = $this->get('translator')->trans(
                'El cliente %nombre% ha sido modificado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            //return $this->redirect($this->generateUrl('usuario_edit', array('id' => $id)));
             return $this->redirect($this->generateUrl('usuario'));
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorusuario',$t);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}/delete", name="usuario_delete")
     * @Method("post")
     */
    public function eliminarclienteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('miomioBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }
            $t = $this->get('translator')->trans(
                'El cliente %nombre% ha sido eliminado correctamente.',
                array('%nombre%' => $entity->getNombre())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuario'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
