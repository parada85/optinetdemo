<?php
namespace mio\mioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mio\mioBundle\Entity\Usuario;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\Common\Persistence\ObjectManager;

class LoadUsuarioData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
      
    $caracteres = 'abcdefghijklmnopqrstuvwxyz';
    $nombres = array('Mario', 'Juan', 'Pedro', 'Jose', 'Luis', 'Enrique', 'Raul', 'Juan Jose', 'Alberto', 'Antonio', 'Manuel', 'Diego','Jesus','Oscar','Juan Manuel', 'Álvaro','Maria', 'Angela', 'Lola', 'Davinia', 'Alicia', 'Isabel', 'Laura', 'Carmen', 'Marta', 'Mercedes', 'Sara', 'Julia','Antonia','Teresa','Cristina', 'Raquel');
    $apellidos = array('García','Del monte','Gonzalez', 'Rodriguez', 'Fernandez', 'Lopez', 'Martínez', 'Sanchez', 'Perez', 'Gomez','Martín','Jiménez','Ruiz','Hernandez','Díaz','Moreno','Álvarez','Basi','Romero','Alonso','Guitierrez','Navarro','Torres','Domínguez','Vazquez','Ramos','Gil','Ramírez','Serrano','Blanco','Molina','Suarez','Morales','Ortega','Delgado');
    $mail = array('@gmail.com','@hotmail.es','@yahoo.es','@lycos.es');
    $calles = array('calle Feduchy 3º B','calle San francisco 1º D','calle Mesón 1º E','Calle San Juan bajo drcha','calle Pelota 1º A','Calle columela 2º B','Calle Jose del Toro 2º A','Calle osorio 1º E','Calle Valverde 1º B','Calle Colarte 2º B','Calle San Salvador 2º drcha',' Calle gas 1º izq','Calle Luis Barile 1º A','Av Segunda aguada 3º C','Calle San Gabriel 2º C','Av Marconi 1º B','Calle Grazalema 2º izq','Calle Guadalmesí 1º A','Av Lacave 1º A','Av de la Bahía 1º A','Calle Sotillo 1º E','Calle Arillo 1º C','Calle Palmones 2º B','Calle Guadairo 1º A','Calle Alonso Cano 1º D ','Calle Goya 1º A');
    $localidad = array('Algar','Algodonales','Barbate','Benalup','Bornos','Cádiz','Chipiona','San fernando','Chiclana de la frontera','Espera','Grazalema','Olvera','Puerto Real','Jerez de la frontera','Jimena de la frontera');
    $rand = range(0, count($calles)); 
    $dni='';
    $telefonofijo = "9";
    $telefonomovil = "6";

       for ($i = 0; $i < 25 ; $i++){
        for($j = 0; $j < 8; $j++)
        {
          $numero = mt_rand(0,9);
          $telefonofijo = $telefonofijo . $numero;
          $numero = mt_rand(0,9);
          $telefonomovil = $telefonomovil . $numero;
          $dni = $dni . $numero;
        }
        $numero = mt_rand(0,strlen($caracteres)-1);
        $nnombres = mt_rand(0,count($nombres)-1);
        $napellidos = mt_rand(0,count($apellidos)-1);
        $nlocalidad = mt_rand(0,count($localidad)-1);
        $nmail = mt_rand(0,count($mail)-1);
        $dni = $dni . $caracteres{$numero};
        $usuario = new Usuario();
       	$usuario->setDni($dni);
       	$usuario->setNombre($nombres{$nnombres});
        $usuario->setApellido1($apellidos{$napellidos});
        $napellidos = mt_rand(0,count($apellidos)-1);
        $usuario->setApellido2($apellidos{$napellidos});
        $email = mb_strtolower(str_replace(' ', '', $nombres{$nnombres}) . str_replace(' ', '', $apellidos{$napellidos}) . $mail{$nmail},'UTF-8');
        $cadBuscar = array("á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú"); 
        $cadPoner = array("a", "A", "e", "E", "i", "I", "o", "O", "u", "U"); 
        $email = str_replace ($cadBuscar, $cadPoner, $email);
       	$usuario->setEmail($email);
        $aver = $rand{$i};
       	$usuario->setDireccion($calles{$aver});
       	$usuario->setLocalidad($localidad{$nlocalidad});
       	$usuario->setProvincia("Cádiz");
       	$usuario->setTelefono($telefonofijo);
       	$usuario->setMovil($telefonomovil);
			  $manager->persist($usuario);
        $dni = '';
        $telefonofijo = '9';
        $telefonomovil = '6';   		
    		}
    	$manager->flush();
    }
        
    public function getOrder()
    {
        return 6;     
    }
}