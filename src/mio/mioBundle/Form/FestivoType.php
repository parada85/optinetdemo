<?php

namespace mio\mioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FestivoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fecha','date',array('read_only' => 'true','widget' => 'single_text','format' => 'dd/MM/yyyy','label' => 'Fecha'))
        ;
    }

    public function getName()
    {
        return 'mio_miobundle_festivotype';
    }
}