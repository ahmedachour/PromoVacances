<?php

namespace Gestion\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrixpayementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixPayementTotal')
            ->add('flagvalid')
            ->add('flagpayement')
            ->add('qte')
            ->add('coupon')
            ->add('modePayement')
            ->add('datePayement')
            ->add('user')
            ->add('reservation')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\AdminBundle\Entity\Prixpayement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_adminbundle_prixpayement';
    }
}
