<?php

namespace mio\mioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class InformeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('odavsc','text',array('label' => 'A.V. s/c'))
            ->add('odavcc','text',array('label' => 'A.V con su c'))
            ->add('odesf','text',array('label' => 'ESF'))
            ->add('odcil','text',array('label' => 'CIL'))
            ->add('odeje','text',array('label' => 'EJE'))
            ->add('odav','text',array('label' => 'A.V.'))
            ->add('oiavsc','text',array('label' => 'A.V. s/c'))
            ->add('oiavcc','text',array('label' => 'A.V. con su c'))
            ->add('oiesf','text',array('label' => 'ESF'))
            ->add('oicil','text',array('label' => 'CIL'))
            ->add('oieje','text',array('label' => 'EJE'))
            ->add('oiav','text',array('label' => 'A.V.'))
            ->add('problema','choice',array('attr'  =>  array('class' => 'lista'),'label' => 'Defecto visión','choices' => array('Hipermetropia' => 'Hipermetropia', 'Astigmatismo' => 'Astigmatismo','Miopia' => 'Miopia','Presbicia' => 'Presbicia','Emetrope' => 'Emetrope'),'required'  => true))
            ->add('pupilar','choice',array('attr'  =>  array('class' => 'lista'),'label' => 'Reacción pupilar','choices' => array('Normal' => 'Normal', 'Alterada' => 'Alterada'),'required'  => true))
            ->add('worth','choice',array('attr'  =>  array('class' => 'lista'),'label' => 'Test de Worth','choices' => array('Normal' => 'Normal', 'Alterada' => 'Alterada'),'required'  => true))
            ->add('Amsler','choice',array('attr'  =>  array('class' => 'lista'),'label' => 'Rejilla de Amsler','choices' => array('Normal' => 'Normal', 'Alterada' => 'Alterada'),'required'  => true))
        ;
    }

    public function getName()
    {
        return 'mio_miobundle_informetype';
    }
}
