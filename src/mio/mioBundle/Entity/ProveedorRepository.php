<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProveedorRepository extends EntityRepository {
	
	public function listaproveedor(){
		 return $this->getEntityMAnager()
		 ->createQuery('SELECT p FROM mio\mioBundle\Entity\Proveedor p')
		 ->getResult();
	}
}
?>