<?php

namespace mio\mioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('label' => 'Nombre*'))
            ->add('apellido1','text',array('label' => 'Apellido1*'))
            ->add('apellido2','text',array('label' => 'Apellido2*'))
            ->add('dni','text',array('label' => 'Dni*', 'max_length' => 9))
            ->add('direccion','text',array('label' => 'Dirección*'))
            ->add('localidad','text',array('label' => 'Localidad*'))
            ->add('provincia','text',array('label' => 'Provincia*'))
            ->add('telefono','text',array('label' => 'Teléfono', 'max_length' => 9))
            ->add('movil','text',array('label' => 'Móvil', 'max_length' => 9))
            ->add('email','text',array('label' => 'Email'))
        ;
    }
	public function getDefaultOptions(array $options){
				
		return array ('data_class' => 'mio\mioBundle\Entity\Usuario');
		
		}
    public function getName()
    {
        return 'mio_miobundle_usuariotype';
    }
}