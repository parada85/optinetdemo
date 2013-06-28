<?php

namespace mio\mioBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class SecurityController extends Controller
{

    public function denegadoAction(){

      return $this->render('miomioBundle:Security:denegado.html.twig');
    }

    public function noencontradaAction(){

      return $this->render('miomioBundle:Security:noencontrada.html.twig');
    }

    public function loginAction()
    {
    	  $fecha = new \DateTime('today');
        $request = $this->getRequest();
        $session = $request->getSession();
        // obtiene el error de inicio de sesión si lo hay
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('miomioBundle:Security:login.html.twig', array(
            // el último nombre de usuario ingresado por el usuario
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            'fecha'         => $fecha,
        ));
    }
    public function passolvidadoAction()
    {
        return $this->render('miomioBundle:Security:passolvidado.html.twig');
    }

    public function enviarmailpassAction()
    {
          $repository = $this->getDoctrine()->getRepository('miomioBundle:Empleado');
          $mail = $this->getRequest()->query->get('mail');
          $empleado = $repository->findOneByEmail($mail);
          if ($empleado){
              $claveusuario = $empleado->getClaveusuario();
              $url = $this->get('router')->generate('comprobarmail', array('clave' => $claveusuario), true);
              $message = \Swift_Message::newInstance()
              ->setSubject("Optinet: Contraseña olvidada")
              ->setFrom('paradasymfony@alwaysdata.com')
              ->setTo($mail)
              ->setBody('Alguien ha solicitado generar una nueva contraseña para tu usuario en Optinet.<br/><br/>'.
                            'Si no has sido tu no te preocupes porque este email solo se envía al correo asociado a tu usuario por lo que nadie que no seas tu va a poder leer tus datos:<br/>'.
                            'Email:  '.$mail.'<br/>'.
                            'Por motivos de seguridad debes confirmar que deseas generar una nueva clave haciendo click aqui:<br/>'.
                             $url. '<br/>'.
                            'Si no deseas cambiar tu contraseña simplemente ignora este email.<br/>'.
                            'El equipo de Optinet'
                            ,'text/html');
                $this->get('mailer')->send($message);
            return new Response (1);
          }
        else
        return new Response(0);
    }

    public function comprobarmailAction($clave)
    {
           $estado = false;
           $em = $this->getDoctrine()->getEntityManager(); 
           $repository = $this->getDoctrine()->getRepository('miomioBundle:Empleado');
           $empleado = $repository->findOneByClaveusuario($clave);
           if ($empleado){
               //if ($empleado->getClaveusuario() == $clave){
                $salt = md5(time());
                $psswd = substr( md5(microtime()), 1, 8);
            
                $message = \Swift_Message::newInstance()
              ->setSubject("Optinet: Nueva contraseña generada")
              ->setFrom('paradasymfony@alwaysdata.com')
              ->setTo($empleado->getEmail())
              ->setBody('Hola '.$empleado->getNombre().' '.$empleado->getApellido1().' '.$empleado->getApellido2().'.<br/><br/>'.
                            'Se ha generado una nueva contraseña para que usted pueda entrar de nuevo al sistema:<br/>'.
                            'Nombre usuario:  '.$empleado->getUsername().'<br/>'.
                            'Nueva Contraseña:     '.$psswd.'<br/><br/>'.
                            'Un saludo.'
                            ,'text/html');
                $this->get('mailer')->send($message);

                $encoder = new MessageDigestPasswordEncoder('sha1');
                $password = $encoder->encodePassword($psswd, $salt);

                $claveusuario="";
                $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                mt_srand(microtime() * 1000000); 
                for($i = 0; $i < 20; $i++)
                {
                  $caracter = mt_rand(0,strlen($caracteres)-1);
                  $claveusuario = $claveusuario . $caracteres{$caracter};
                }
                $empleado->setPassword($password);
                $empleado->setSalt($salt);
                $empleado->setClaveusuario($claveusuario);
                $em->persist($empleado);
                $em->flush();
                $estado = true;
                return $this->render('miomioBundle:Security:nuevacontrasena.html.twig',array('estado' => $estado));
            }
            else
                return $this->render('miomioBundle:Security:nuevacontrasena.html.twig',array('estado' => $estado));
    }

    public function cambiarlocaleAction($idioma)
    {
    $this->get('session')->setLocale($idioma);
    $request = $this->get('request');
    return $this->redirect($request->headers->get('referer'));
    }
}

?>