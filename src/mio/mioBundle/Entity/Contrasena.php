<?php
namespace mio\mioBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contrasena
{
    /**
     * @Assert\UserPassword(message = "la contraseña no coincide")
     */
     
    public $name;
}

?>