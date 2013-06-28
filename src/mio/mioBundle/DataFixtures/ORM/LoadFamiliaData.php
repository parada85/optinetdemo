<?php
namespace mio\mioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mio\mioBundle\Entity\Familia;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\Common\Persistence\ObjectManager;

class LoadFamiliaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         	
       for ($i = 0; $i < 5 ; $i++){
       	$familia = new Familia();
       	if ($i==0) $familia->setnombre("Lentillas");
        if ($i==1) $familia->setnombre("Monturas");
        if ($i==2) $familia->setnombre("Gafas sol");
        if ($i==3) $familia->setnombre("Accesorios");
        if ($i==4) $familia->setnombre("Limpiadores");
			  $manager->persist($familia);
			  $this->addReference("familia$i", $familia);  	    		
    		}
    	$manager->flush();
    }
        
    public function getOrder()
    {
        return 4;     
    }
}