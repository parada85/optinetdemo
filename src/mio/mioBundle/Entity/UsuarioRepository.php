<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository {
	public function listausuario(){
		 return $this->getEntityManager()
		 ->createQuery('SELECT p FROM mio\mioBundle\Entity\Usuario p')
		 ->getResult();
	}
}
?>