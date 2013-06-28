<?php

namespace mio\mioBundle;

use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\EntityManager;
use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Medico;
use mio\mioBundle\Entity\Producto;
use mio\mioBundle\Entity\Proveedor;
use mio\mioBundle\Entity\Usuario;
use mio\mioBundle\Entity\Cita;
use mio\mioBundle\Entity\Festivo;
use mio\mioBundle\Entity\Modificacion;
use mio\mioBundle\Entity\Pedido;
use mio\mioBundle\Entity\Venta;
use mio\mioBundle\Entity\Reserva;
use mio\mioBundle\Entity\Devolucion;
use mio\mioBundle\Entity\Familia;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\UnitOfWork;

class ListenerCrud{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onFlush(onFlushEventArgs $eventArgs)
        {
                $em = $eventArgs->getEntityManager();
                $uow = $em->getUnitOfWork();

                foreach ($uow->getScheduledEntityInsertions() AS $entity) {
if ($entity instanceof Usuario||$entity instanceof Producto||$entity instanceof Proveedor || $entity instanceof Familia || $entity instanceof Festivo|| $entity instanceof Pedido || $entity instanceof Empleado || $entity instanceof Medico){
                        $modificacion = new Modificacion();
                        $modificacion->setFechamod(new \DateTime('now'));
                        $className = join('', array_slice(explode('\\', get_class($entity)), -1));
                        $modificacion->setEntidad($className);
                        $modificacion->setTipo('Inserción');
                        $modificacion->setIdentificador($entity->getId());
                        $objetos = $em->getRepository('miomioBundle:'.$className)->findAll();
                        if ($objetos){//por si todavia no hay ninguna entrada.
                            $last_item = end($objetos);
                            $last_item = $last_item->getId() + 1; 
                            $modificacion->setIdentificador($last_item);
                            }
                        else{
                            $modificacion->setIdentificador("1");
                        }
                        $securityContext = $this->container->get('security.context');
                        if ($securityContext->getToken() != null)//para los fixtures
                            $modificacion->setEmpleado($securityContext->getToken()->getUser());
                        if ($entity instanceof Pedido)
                            $modificacion->setInfo('Total:'.$entity->getTotal().' €');
                        else
                            $modificacion->setInfo('');
                        $em->persist($modificacion);
                        $classMetadata = $em->getClassMetadata(get_class($modificacion));
                        $uow->computeChangeSet($classMetadata, $modificacion);
                        }
if ($entity instanceof Cita||$entity instanceof Venta ||$entity instanceof Devolucion ||$entity instanceof Reserva) {
                        $modificacion = new Modificacion();
                        $modificacion->setFechamod(new \DateTime('now'));
                        $className = join('', array_slice(explode('\\', get_class($entity)), -1));
                        $modificacion->setEntidad($className);
                        $modificacion->setTipo('Inserción');
                        $modificacion->setIdentificador($entity->getId());
                        $objetos = $em->getRepository('miomioBundle:Operacion')->findAll();
                        if ($objetos){//por si todavia no hay ninguna entrada.
                            $last_item = end($objetos);
                            $last_item = $last_item->getId() + 1; 
                            $modificacion->setIdentificador($last_item);
                            }
                        else{
                            $modificacion->setIdentificador("1");
                        }
                        $securityContext = $this->container->get('security.context');
                        if ($securityContext->getToken() != null)//para los fixtures
                            $modificacion->setEmpleado($securityContext->getToken()->getUser());
                        if ( $entity instanceof Venta ||$entity instanceof Devolucion ||$entity instanceof Reserva)
                            $modificacion->setInfo('Total:'.$entity->getTotal().' €');
                        else
                            $modificacion->setInfo('');
                        $em->persist($modificacion);
                        $classMetadata = $em->getClassMetadata(get_class($modificacion));
                        $uow->computeChangeSet($classMetadata, $modificacion);
                        }
                    }
                    //realacion de reserva a venta no la comtemplo...
                    foreach ($uow->getScheduledEntityUpdates() as $entity) {
if ($entity instanceof Usuario||$entity instanceof Producto||$entity instanceof Proveedor||$entity instanceof Cita||$entity instanceof Festivo ||$entity instanceof Familia ||$entity instanceof Venta || $entity instanceof Pedido || $entity instanceof Empleado || $entity instanceof Medico) {                        
                        $campos = "";
                        $modificacion = new Modificacion();
                        $modificacion->setFechamod(new \DateTime('now'));
                        $className = join('', array_slice(explode('\\', get_class($entity)), -1));
                        if( strpos( $className, 'Bundle' ) !== false )
                            $modificacion->setEntidad('Producto');
                         else
                            $modificacion->setEntidad($className);
                        $modificacion->setIdentificador($entity->getId());
                        $modificacion->setTipo('Modificación');
                        $securityContext = $this->container->get('security.context');
                        if ($securityContext->getToken()->getUser() instanceof Empleado )//para pass olvidado
                            $modificacion->setEmpleado($securityContext->getToken()->getUser());
                        else
                            $modificacion->setEmpleado($entity);
                        
                        $changeset = $uow->getEntityChangeSet($entity);
                        if (!$entity instanceof Pedido){
                        foreach ($changeset AS $field => $vals)
                            if ($field == 'fechacita' || $field == 'fechaoper'){
                                if ($field != 'fechaoper'){ 
                                list($oldValue, $newValue) = $vals;
                                $campos = $campos . $field .':'.$oldValue->format('d-m-Y H:i:s') .' '.$newValue->format('d-m-Y H:i:s').' ';
                                    }
                                }
                            else{
                                if ($field == 'claveusuario' || $field == 'password' || $field == 'salt')
                                    $campos ="Contraseña cambiada";
                                else{
                                    list($oldValue, $newValue) = $vals;
                                    $campos = $campos . $field .':'.$oldValue .' '.$newValue.' ';
                                        }
                                }
                            }
                        $modificacion->setInfo($campos);
                        $em->persist($modificacion);
                        $classMetadata = $em->getClassMetadata(get_class($modificacion));
                        $uow->computeChangeSet($classMetadata, $modificacion);
                        }
                }

                foreach ($uow->getScheduledEntityDeletions() AS $entity) {
if ($entity instanceof Usuario||$entity instanceof Producto||$entity instanceof Proveedor|| $entity instanceof Familia || $entity instanceof Cita||$entity instanceof Festivo) {                        
                        $modificacion = new Modificacion();
                        $modificacion->setFechamod(new \DateTime('now'));
                        $className = join('', array_slice(explode('\\', get_class($entity)), -1));
                        $modificacion->setEntidad($className);
                        $modificacion->setIdentificador('');
                        $modificacion->setTipo('Eliminación');
                        $securityContext = $this->container->get('security.context');
                        $modificacion->setEmpleado($securityContext->getToken()->getUser());
                        if ($entity instanceof Cita)
                            $modificacion->setInfo($entity->getFechacita()->format('d-m-Y H:i:s'). ' '. $entity->getCliente()->getNombre().' '.$entity->getCliente()->getApellido1());
                        if ($entity instanceof Usuario)
                            $modificacion->setInfo($entity->getNombre().' '.$entity->getApellido1(). ' '.$entity->getApellido2(). ' '.$entity->getDni());
                        if ($entity instanceof Producto)
                            $modificacion->setInfo($entity->getDescripcion());
                        if ($entity instanceof Proveedor)
                            $modificacion->setInfo($entity->getNombre());
                        if ($entity instanceof Familia)
                            $modificacion->setInfo($entity->getNombre());
                        if ($entity instanceof Festivo)
                            $modificacion->setInfo($entity->getFecha()->format('d-m-Y H:i:s'));
                        $em->persist($modificacion);
                        $classMetadata = $em->getClassMetadata(get_class($modificacion));
                        $uow->computeChangeSet($classMetadata, $modificacion);
                        }
                    }

                foreach ($uow->getScheduledCollectionDeletions() AS $col) {
if ($entity instanceof Usuario||$entity instanceof Producto||$entity instanceof Proveedor||$entity instanceof Cita||$entity instanceof Festivo||$entity instanceof Venta || $entity instanceof Pedido || $entity instanceof Empleado ) {                        
                        $modificacion = new Modificacion();
                        $modificacion->setFechamod(new \DateTime('now'));
                        $className = join('', array_slice(explode('\\', get_class($entity)), -1));
                        $modificacion->setEntidad($className);
                        $modificacion->setIdentificador('coleccion');
                        $modificacion->setTipo('Mover');
                        $securityContext = $this->container->get('security.context');
                        $modificacion->setEmpleado($securityContext->getToken()->getUser());
                        $modificacion->setInfo($col);
                        $em->persist($modificacion);
                        $classMetadata = $em->getClassMetadata(get_class($modificacion));
                        $uow->computeChangeSet($classMetadata, $modificacion);
                        }
                    }

                    foreach ($uow->getScheduledCollectionUpdates() AS $col) {
if ($entity instanceof Usuario||$entity instanceof Producto||$entity instanceof Proveedor||$entity instanceof Cita||$entity instanceof Festivo||$entity instanceof Venta ||$entity instanceof Reserva || $entity instanceof Pedido || $entity instanceof Empleado ) {  
                        $modificacion = new Modificacion();
                        $modificacion->setFechamod(new \DateTime('now'));
                        $className = join('', array_slice(explode('\\', get_class($entity)), -1));
                        $modificacion->setEntidad($className);
                        $modificacion->setIdentificador('coleccion');
                        $modificacion->setTipo('MoverUpdate');
                        $securityContext = $this->container->get('security.context');
                        $modificacion->setEmpleado($securityContext->getToken()->getUser());
                        $modificacion->setInfo($col);
                        $em->persist($modificacion);
                        $classMetadata = $em->getClassMetadata(get_class($modificacion));
                        $uow->computeChangeSet($classMetadata, $modificacion);
                    }
                }   
        }
}   
?>