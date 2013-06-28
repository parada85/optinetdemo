<?php

namespace mio\mioBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductoRepository extends EntityRepository {
	
	public function listaproducto(){
		 return $this->getEntityManager()
		 ->createQuery('SELECT a FROM mio\mioBundle\Entity\Producto a')
		 ->getResult();
	}
}
?>