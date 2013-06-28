<?php

namespace mio\mioBundle;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\SecurityContext;
use mio\mioBundle\Entity\Log;

class AuthenticationHandler extends ContainerAware implements AuthenticationSuccessHandlerInterface,LogoutSuccessHandlerInterface{

	protected $router;
	protected $em;
    protected $security;  

    public function __construct(RouterInterface $router, EntityManager $entityManager, SecurityContext $security)
    {
        $this->em = $entityManager;
        $this->router = $router;
        $this->security = $security;
    }

	public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
    	$empleado = $token->getUser();
        $session = $request->getSession();
        $session->setLocale($empleado->getIdioma());
        $log = new Log();
        $log->setFechalog(new \DateTime('now'));
        $log->setTipo("Entrada");
        $log->setEmpleado($empleado);
    	$this->em->persist($log);
    	$this->em->flush();
    	return new RedirectResponse($this->router->generate('homepage'));
    }

    /*
    public  function onAuthenticationFailure(Request $request, AuthenticationException $exception){

        return new Response($this->translator->trans($exception->getMessage()));
    }
    */
    public function onLogoutSuccess(Request $request){
        $empleado =  $this->security->getToken()->getUser();
        $log = new Log();
        $log->setFechalog(new \DateTime('now'));
        $log->setTipo("Salida");
        $log->setEmpleado($empleado);
        $this->em->persist($log);
        $this->em->flush();
        return new RedirectResponse($this->router->generate('login'));
    }
}
?>