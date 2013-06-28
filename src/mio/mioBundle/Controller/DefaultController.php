<?php

namespace mio\mioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
    	/*$session = $this->getRequest()->getSession();
    	echo $session ->getId();
    	$response = new Response();
        $response->headers->set('Content-Type', 'text/plain');
        echo $response->headers->get('Content-Type', 'text/plain');
        print_r( $this->getRequest()->headers->get('user-agent'));
        */
        return $this->render('miomioBundle:Default:index.html.twig');
    }
}
