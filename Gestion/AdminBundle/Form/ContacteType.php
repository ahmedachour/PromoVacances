<?php

namespace Gestion\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContacteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('ville')
            ->add('teleph')
            ->add('email')
            ->add('pays')
            ->add('codeP')
            ->add('msg')
            ->add('repondre')
            ->add('lire')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\AdminBundle\Entity\Contacte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_adminbundle_contacte';
    }
}
