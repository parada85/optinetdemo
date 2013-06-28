<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\EntityRepository;

class OperacionRepository extends EntityRepository {
	public function listaoperacion(){
		 return $this->getEntityManager()
		 ->createQuery('SELECT o FROM mio\mioBundle\Entity\Operacion o')
		 ->getResult();
	}
}
?>