<?php
namespace mio\mioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Role;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\Common\Persistence\ObjectManager;

class LoadEmpleadoData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         
      $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $caracteres1 = 'abcdefghijklmnopqrstuvwxyz';
      $dni='';

        for ($i = 0; $i < 3 ; $i++){
        for($j = 0; $j < 8; $j++)
        {
          $numero = mt_rand(0,9);
          $dni = $dni . $numero;
        }
        $numero = mt_rand(0,strlen($caracteres1)-1);
        $caracter = $caracteres1{$numero};
        $dni = $dni . $caracteres1{$numero};
        $empleado = new Empleado();
			  $empleado->setDni($dni);
        if ($i == 0 ){
          $empleado->setNombre("José Ángel");
          $empleado->setUsername("joseangel");
          $empleado->setApellido1("Parada");
          $empleado->setApellido2("Jiménez");
          $empleado->setEmail("paradajimenez85@gmail.com");
          $empleado->setDireccion("Al andalus 13 6º A");
          $empleado->setTelefono("956890882");
          $empleado->setMovil("625038674");
          $empleado->setIdioma("es");
          $empleado->setTema("cobalt");
          $pass = "joseangel";
        }
        if ($i == 1){
          $empleado->setNombre("José");
          $empleado->setUsername("jose");
          $empleado->setApellido1("Parada");
          $empleado->setApellido2("Payero");
          $empleado->setEmail("paradita85@gmail.com");
          $empleado->setDireccion("Al andalus 13 6º A");
          $empleado->setTelefono("956890882");
          $empleado->setMovil("665540839");
          $empleado->setIdioma("es");
          $empleado->setTema("aristo");
          $pass = "jose";

        }

        if ($i == 2){
          $empleado->setNombre("Rosario");
          $empleado->setUsername("rosario");
          $empleado->setApellido1("Jiménez");
          $empleado->setApellido2("Padilla");
          $empleado->setEmail("parada85@hotmail.es");
          $empleado->setDireccion("Al andalus 13 6º A");
          $empleado->setTelefono("956890882");
          $empleado->setMovil("654343536");
          $empleado->setIdioma("en");
          $empleado->setTema("cobalt");
          $pass = "rosario";

        }
       	$empleado->setLocalidad("San fernando");
       	$empleado->setProvincia("Cádiz");
       	$empleado->setFechaAlta(new \DateTime());
       	$empleado->setActivo(1);
       	$empleado->setSalt(md5(time()));
        $claveusuario='';
        mt_srand(microtime() * 1000000); 
        for($j = 0; $j < 20; $j++)
        {
          /* Genera un valor aleatorio mejorado con mt_rand, entre 0 y el tamaño del array $caracteres menos 1. Posteríormente vamos concatenando en la cadena $password
          los caracteres que se van eligiendo aleatoriamente.*/
          $caracter = mt_rand(0,strlen($caracteres)-1);
          $claveusuario = $claveusuario . $caracteres{$caracter};
        }
        $empleado->setClaveusuario($claveusuario);
       	
       	/********************contraseña*****************/
       	$encoder = new MessageDigestPasswordEncoder('sha1');
        $password = $encoder->encodePassword($pass, $empleado->getSalt());
        $empleado->setPassword($password);
       	/***************************************/
       	//$empleado->getUserRoles()->add($role);
       	 if ($i==0)
    				$empleado->setRole($this->getReference('admin-role'));
 			    else 
					   $empleado->setRole($this->getReference('user-role'));
			$manager->persist($empleado);
      $dni='';	
    		}
    	$manager->flush();
    	// store reference of admin-user for other Fixtures
      //$this->addReference('admin-user', $empleado);
     }
        
    public function getOrder()
    {
        return 1;     
    }
}