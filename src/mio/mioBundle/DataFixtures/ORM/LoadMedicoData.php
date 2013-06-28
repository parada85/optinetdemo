<?php
namespace mio\mioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mio\mioBundle\Entity\Medico;
use mio\mioBundle\Entity\Role;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\Common\Persistence\ObjectManager;

class LoadMedicoData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         
      $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $caracteres1 = 'abcdefghijklmnopqrstuvwxyz';
      $dni='';

        for ($i = 0; $i < 2 ; $i++){
        for($j = 0; $j < 8; $j++)
        {
          $numero = mt_rand(0,9);
          $dni = $dni . $numero;
        }
        $numero = mt_rand(0,strlen($caracteres1)-1);
        $caracter = $caracteres1{$numero};
        $dni = $dni . $caracteres1{$numero};
        $medico = new Medico();
		    $medico->setDni($dni);
        if ($i == 0){
          $medico->setNombre("Juan");
          $medico->setUsername("juan");
          $pass = "juan";
          $medico->setApellido1("Ramirez");
          $medico->setApellido2("Lopez");
         	$medico->setEmail("medico1optinet@gmail.com");
         	$medico->setDireccion("Calle malaspina 1º A");
         	$medico->setLocalidad("San fernando");
         	$medico->setProvincia("Cadiz");
         	$medico->setTelefono("956098765");
         	$medico->setMovil("625988776");
          $medico->setIdioma("es");
          $medico->setTema("cobalt");
         	$medico->setFechaAlta(new \DateTime());
         	$medico->setActivo(1);
         	$medico->setTitulacion("Grado en Óptica");
         	$medico->setNumero("16972");
          $medico->setColor('#1153ed');
         }
         else{
          $medico->setNombre("Pedro");
          $medico->setUsername("pedro");
          $pass = "pedro";
          $medico->setApellido1("Callealta");
          $medico->setApellido2("Gonzalez");
          $medico->setEmail("medico2optinet@gmail.com");
          $medico->setDireccion("Calle bienvenida 2º D");
          $medico->setLocalidad("San fernando");
          $medico->setProvincia("Cadiz");
          $medico->setTelefono("956768795");
          $medico->setMovil("625918356");
          $medico->setIdioma("es");
          $medico->setTema("aristo");
          $medico->setFechaAlta(new \DateTime());
          $medico->setActivo(1);
          $medico->setTitulacion("Diplomatira en Óptica");
          $medico->setNumero("14378");
          $medico->setColor('#8e39e3');
         }

       	$medico->setSalt(md5(time()));
        $claveusuario='';
        mt_srand(microtime() * 1000000); 
        for($j = 0; $j < 20; $j++)
        {
          /* Genera un valor aleatorio mejorado con mt_rand, entre 0 y el tamaño del array $caracteres menos 1. Posteríormente vamos concatenando en la cadena $password
          los caracteres que se van eligiendo aleatoriamente.*/
          $caracter = mt_rand(0,strlen($caracteres)-1);
          $claveusuario = $claveusuario . $caracteres{$caracter};
        }
        $medico->setClaveusuario($claveusuario);
       	
       	/********************contraseña*****************/
       	$encoder = new MessageDigestPasswordEncoder('sha1');
        $password = $encoder->encodePassword($pass, $medico->getSalt());
        $medico->setPassword($password);
		$medico->setRole($this->getReference('med-role'));
		$manager->persist($medico);
    $dni='';
		}
    	$manager->flush();
     }
        
    public function getOrder()
    {
        return 2;     
    }
}