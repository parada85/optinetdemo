<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ContactoController extends Controller
{
    
    public function contactoAction()
    {
    	$email = $this->getRequest()->query->get('email');
    	$mensaje = $this->getRequest()->query->get('mensaje');
	$message = \Swift_Message::newInstance()
        ->setSubject("Formulario de contacto aplicación optinet")
        ->setFrom('paradasymfony@alwaysdata.com')
        ->setTo("paradajimenez85@gmail.com")
        ->setBody("Mensaje de $email: $mensaje")
    ;
    $this->get('mailer')->send($message);

    return new Response();
    }
}
