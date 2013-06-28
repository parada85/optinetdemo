<?php
namespace mio\mioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mio\mioBundle\Entity\Empleado;
use mio\mioBundle\Entity\Role;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\Common\Persistence\ObjectManager;

class LoadEmpleadoRoleData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $adminRole = new Role();
        $adminRole->setName('ROLE_A');

        $userRole = new Role();
        $userRole->setName('ROLE_U');

        $medRole = new Role();
        $medRole->setName('ROLE_M');

        $manager->persist($adminRole);
        $manager->persist($userRole);
        $manager->persist($medRole);
        $manager->flush();

        $this->addReference('admin-role', $adminRole);
		$this->addReference('user-role', $userRole);
        $this->addReference('med-role', $medRole);
    }
}