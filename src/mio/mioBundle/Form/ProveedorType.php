<?php

namespace mio\mioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('label' => 'Nombre*'))
            ->add('direccion','text',array('label' => 'Dirección'))
            ->add('localidad','text',array('label' => 'Localidad'))
            ->add('provincia','text',array('label' => 'Provincia'))
            ->add('email','text',array('label' => 'Email'))
            ->add('telefono','text',array('label' => 'Teléfono', 'max_length' => 9))
        ;
    }

    public function getName()
    {
        return 'mio_miobundle_proveedortype';
    }
}
