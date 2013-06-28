<?php
namespace mio\mioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mio\mioBundle\Entity\Producto;
use mio\mioBundle\Entity\Proveedor;
use mio\mioBundle\Entity\Familia;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Doctrine\Common\Persistence\ObjectManager;

class LoadProductoData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
      $lentillas = array('air optix aqua +2.5','Biofinity +1.25','Biofinity -1.25','Biofinity -0.75','Biofinity +2.5','Biofinity +2','acuvue Oasys +3','Proclear sphere -1','Soflens 59 +0.5','softlens 38 +0.25','Proclear toric +1','Biomedics 55 evolution +1.5','Purevision +1');
      $graduadas = array('Rayban rx 5114','Polo Ralph OPH 2039','Polo Ralph ORA 7021','Rayban rx 7026','Rayban rx 2312','Prada Pr 10FV','Boss orange 0036','Carrera Ca 6175','Gucci GG 1612','Police v 1677','Vogue dd 2555','Oakley ox 1066','Nike 4162','Adidas Fc 2343');
      $sol = array('Vogue 3846s','Vogue 2832sb','Vogue 2795s','Vogue 2818s','Prada 27ps','Prada 29ps','Prada 21ps','Polo Ralph 4076','Polo Ralph 4077','Bvigari 8113B','Bvigari 8105B','Bvigari 8116B','Chanel 5434','Chanel 3454','Chanel 2343T','Chanel 2378r','Chanel 3456','Chanel 5467','Arnette 4544','Arnette 4514','Arnette 4678','Arnette 4554y','Gucci 4544','Gucci 4333','Carrera 6000R','Carrera 5003','Hugo Boss 0522S','Hugo boss 0567E','Hugo Boss 04556','Hugo boss 0513S','Rayban 3503','Rayban 4167','Rayban Aviator 3015','Rayban Aviator 3012','Rayban Aviator 3011','Rayban Aviator 2034','Rayban Aviator 2343');
      $accesorios = array('Estuche ranas','Estuche pez','Estuche ositos','estuche eclipse','estuche elefantes','estuche cerditos','estuche de otoño','lupa regla 210mm','cadena dorada 0406','cadena roja 0456','cadena marron 0426','estuche polka');
      $limpiadores = array('Sibosol set','optifree express 500ml','renu multiplus 240ml','solocare aqua 360ml','biotrue 300ml','sibosol 250ml','gotas Ciba aguify','Easysept','Complete','Oxysept 1 step','opticrom gotas 5ml','iclean 50ml','boston simplus 120ml');
      $numero = array("4","8","18","21");
      $nlentillas = count($lentillas);
      $ngraduadas = count($graduadas);
      $nsol = count($sol);
      $naccesorios = count($accesorios);
      $nlimpiadores = count($limpiadores);

      for ($i = 0; $i < $nlentillas ; $i++){
       	$producto = new Producto();
       	$producto->setDescripcion($lentillas{$i});
			  $producto->setReservado(0);
        $producto->setApartado(0);
        mt_srand(microtime() * 1000000); 
        $producto->setStock(mt_rand(0,200));
       	$producto->setPcompra(round((mt_rand(0,100)/3) * 100)/100);
        $producto->setPventa(round($producto->getPcompra() + mt_rand(0,100) * 2 /3, 2));
        $aleat = mt_rand(0,3);
       	$producto->setIva($numero{$aleat});
       	$producto->setProveedor($this->getReference("proveedor$aleat"));
       	$producto->setFamilia($this->getReference("familia0"));
			  $manager->persist($producto);
    		}
        for ($i = 0; $i < $ngraduadas ; $i++){
        $producto = new Producto();
        $producto->setDescripcion($graduadas{$i});
        $producto->setReservado(0);
        $producto->setApartado(0);
        mt_srand(microtime() * 1000000); 
        $producto->setStock(mt_rand(0,200));
        $producto->setPcompra(round((mt_rand(0,100)/3) * 100)/100);
        $producto->setPventa(round($producto->getPcompra() + mt_rand(0,100) * 2 /3, 2));
        $aleat = mt_rand(0,3);
        $producto->setIva($numero{$aleat});
        $producto->setProveedor($this->getReference("proveedor$aleat"));
        $producto->setFamilia($this->getReference("familia1"));
        $manager->persist($producto);
        }
        for ($i = 0; $i < $nsol ; $i++){
        $producto = new Producto();
        $producto->setDescripcion($sol{$i});
        $producto->setReservado(0);
        $producto->setApartado(0);
        mt_srand(microtime() * 1000000); 
        $producto->setStock(mt_rand(0,200));
        $producto->setPcompra(round((mt_rand(0,100)/3) * 100)/100);
        $producto->setPventa(round($producto->getPcompra() + mt_rand(0,100) * 2 /3, 2));
        $aleat = mt_rand(0,3);
        $producto->setIva($numero{$aleat});
        $producto->setProveedor($this->getReference("proveedor$aleat"));
        $producto->setFamilia($this->getReference("familia2"));
        $manager->persist($producto);
        }
        for ($i = 0; $i < $naccesorios ; $i++){
        $producto = new Producto();
        $producto->setDescripcion($accesorios{$i});
        $producto->setReservado(0);
        $producto->setApartado(0);
        mt_srand(microtime() * 1000000); 
        $producto->setStock(mt_rand(0,200));
        $producto->setPcompra(round((mt_rand(0,100)/3) * 100)/100);
        $producto->setPventa(round($producto->getPcompra() + mt_rand(0,100) * 2 /3, 2));
        $aleat = mt_rand(0,3);
        $producto->setIva($numero{$aleat});
        $producto->setProveedor($this->getReference("proveedor$aleat"));
        $producto->setFamilia($this->getReference("familia3"));
        $manager->persist($producto);
        }
        for ($i = 0; $i < $nlimpiadores ; $i++){
        $producto = new Producto();
        $producto->setDescripcion($limpiadores{$i});
        $producto->setReservado(0);
        $producto->setApartado(0);
        mt_srand(microtime() * 1000000); 
        $producto->setStock(mt_rand(0,200));
        $producto->setPcompra(round((mt_rand(0,100)/3) * 100)/100);
        $producto->setPventa(round($producto->getPcompra() + mt_rand(0,100) * 2 /3, 2));
        $aleat = mt_rand(0,3);
        $producto->setIva($numero{$aleat});
        $producto->setProveedor($this->getReference("proveedor$aleat"));
        $producto->setFamilia($this->getReference("familia4"));
        $manager->persist($producto);
        }
    	$manager->flush();
    }
        
    public function getOrder()
    {
        return 5;     
    }
}