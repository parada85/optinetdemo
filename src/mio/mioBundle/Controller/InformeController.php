<?php

namespace mio\mioBundle\Controller;
use Ps\PdfBundle\Annotation\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use mio\mioBundle\Entity\Informe;
use mio\mioBundle\Entity\Cita;
use mio\mioBundle\Entity\Medico;
use mio\mioBundle\Form\InformeType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Informe controller.
 *
 * @Route("/informe")
 */
class InformeController extends Controller
{
    /**
     * Lists all Informe entities.
     *
     * @Route("/", name="informe")
     * @Template()
     */
    public function listarinformesAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('miomioBundle:Informe')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Informe entity.
     *
     * @Route("/{id}/show", name="informe_show")
     * @Template()
     */
    public function verinformeAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('miomioBundle:Informe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Informe entity.');
        }
        $editForm = $this->createForm(new InformeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Informe entity.
     *
     * @Route("/new", name="informe_new")
     * @Template()
     */
    public function crearinformeAction($id,$id1)
    {
        $entity = new Informe();
        $form   = $this->createForm(new InformeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'id' => $id,
            'id1' => $id1
        );
    }

    /**
     * Creates a new Informe entity.
     *
     * @Route("/create", name="informe_create")
     * @Method("post")
     * @Template("miomioBundle:Informe:new.html.twig")
     */
    public function createAction($id,$id1)
    {
        $entity  = new Informe();
        $request = $this->getRequest();
        $form    = $this->createForm(new InformeType(), $entity);
        $form->bindRequest($request);

        $em = $this->getDoctrine()->getEntityManager();
        if ($id==0){//crear informe sin cita
            $cita=new Cita();
            $cita->setEmpleado($this->get('security.context')->getToken()->getUser());
            $cita->setMedico($this->get('security.context')->getToken()->getUser());
            $cita->setFechacita(new \DateTime('now'));
            $cita->setFechaoper(new \DateTime('now'));
            $cliente = $em->getRepository('miomioBundle:Usuario')->find($id1);
            $cita->setCliente($cliente);
            $entity->setCita($cita);
        }
        else{
            $cita = $em->getRepository('miomioBundle:Cita')->find($id);
            $entity->setCita($cita);
        }
            $entity->setFecha(new \DateTime('now'));

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->persist($cita);
            $em->flush();
            $t = $this->get('translator')->trans(
                'El informe %nombre% ha sido creado correctamente.',
                array('%nombre%' => $entity->getId())
            );
            $this->get('session')->setFlash('confirmacion',$t);

            return $this->redirect($this->generateUrl('informe'));
            
        }
        $t = $this->get('translator')->trans('Se ha producido algún error. Revise los datos.');
        $this->get('session')->setFlash('errorinforme',$t);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

     public function nuevoAction(){ 
        return ($this->render('miomioBundle:Informe:nuevoinforme.html.twig'));
    }

    /**
 * @Pdf()
 */
    public function generardocumentoinformeAction($id)
    {
    $informe = $this->getDoctrine()->getRepository('miomioBundle:Informe')->find($id);
    $cliente = $informe->getCita()->getCliente();
    $medico = $informe->getCita()->getMedico();
    $pdf = $this->render(sprintf('miomioBundle:Informe:informepdf.pdf.twig'), array('cliente' => $cliente,'medico' => $medico,'informe' => $informe));

    /*$facade = $this->get('ps_pdf.facade');
    $xml = $pdf->getContent();    
    $content = $facade->render($xml);    
    $pdf1 = new Response($content, 200, array('content-type' => 'application/pdf'));
    file_put_contents('informe'.$informe->getId().'.pdf', $pdf1);
    */
    return $pdf;
    }

    public function nuevo1Action(){
        
        $em = $this->getDoctrine()->getEntityManager();
        $clientes = $em->getRepository('miomioBundle:Usuario')->findAll();

        return $this->render('miomioBundle:Informe:nuevoinforme1.html.twig',array('clientes' => $clientes));
    }
}
