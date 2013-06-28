<?php

namespace mio\mioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CitaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fechacita','datetime',array('read_only' => 'true','widget' => 'single_text','date_format' => 'dd-MMM-yyyy','label' => 'Fecha cita'))
            ->add('cliente',null,array('attr'  =>  array('class' => 'lista'),'read_only' => 'true','label'=>'Cliente'))
            ->add('medico',null,array('attr'  =>  array('class' => 'lista'),'read_only' => 'true','label' => 'Médico'))
        ;
    }

    public function getName()
    {
        return 'mio_miobundle_citatype';
    }
}