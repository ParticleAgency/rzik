<?php

namespace Audio\AudioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AudioType extends AbstractType
{


    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('required' => false))
            ->add('description', 'textarea', array('required' => false))
            ->add('artist', 'text', array('required' => false))
            ->add('composer', 'text', array('required' => false))
            ->add('explicitcontent', 'checkbox', array('required' => false))
            ->add('duration', 'text', array('required' => false))
            ->add('audiofilename', AudioType::class, array('label' => 'Fichier audio'))
            ->add('imagefilename', AudioType::class, array('label' => 'Cover', 'required' => false))
            ->add('submit', 'submit')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Audio\AudioBundle\Entity\Audio'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'audio_audiobundle_audio';
    }


}
