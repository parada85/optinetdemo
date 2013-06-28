<?php

namespace mio\mioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('descripcion','text',array('label' => 'Descripción*'))
            ->add('pcompra','text',array('label' => 'Precio compra*'))
            ->add('pventa','text',array('label' => 'Precio venta*'))
            ->add('iva','text',array('label' => 'Iva*','max_length' => 2))
            ->add('stock','text',array('label' => 'Stock*'))
            ->add('familia', null, array('attr'  =>  array('class' => 'lista'),'empty_value' => 'Seleccione'))
            ->add('proveedor', null, array('attr'  =>  array('class' => 'lista'),'empty_value' => 'Seleccione'));
    }

	public function getDefaultOptions(array $options){
				
		return array ('data_class' => 'mio\mioBundle\Entity\Producto');
		
		}
    public function getName()
    {
        return 'mio_miobundle_productotype';
    }
}
?>