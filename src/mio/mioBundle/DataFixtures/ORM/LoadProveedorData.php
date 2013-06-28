<?php
namespace mio\mioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mio\mioBundle\Entity\Proveedor;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\Common\Persistence\ObjectManager;

class LoadProveedorData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
      $nombres = array('gafaskost','esunvision','ocho8','Puckator','luxottica','termopower','solextrem','dipo');
      $localidad = array('Madrid','Aranjuez','Boadilla del monte','Fuenlabrada','Getafe','Alcorcón','Alcobendas','Léganes');
      $calles = array('Calle Dolorosa 3','calle Villafuerte 23','calle los bohemihos 1','calle de la generosidad 12','av de la felicidad 32','calle humanidad 11','calle dulzura 34','calle conciliación 5');
      $telefono = "9";
       for ($i = 0; $i < 8 ; $i++){
       	$proveedor = new Proveedor();
       	$proveedor->setNombre($nombres{$i});
       	$proveedor->setDireccion($calles{$i});
        for($j = 0; $j < 8; $j++)
        {
          $numero = mt_rand(0,9);
          $telefono = $telefono . $numero;
        }

			  $proveedor->setTelefono($telefono);
        $proveedor->setLocalidad($localidad{$i});
       	$proveedor->setProvincia("Madrid");
       	$proveedor->setEmail($nombres{$i}."@hotmail.com");
			  $manager->persist($proveedor);
			  $this->addReference("proveedor$i", $proveedor);
        $telefono = "9";  		
    		}
    	$manager->flush();
    }
        
    public function getOrder()
    {
        return 3;     
    }
}