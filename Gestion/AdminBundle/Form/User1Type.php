<?php

namespace Gestion\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class User1Type extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
               ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
                ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                 ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'votre.mot passe .nest pas identique',
                ))
               

              
          
            ->add('teleph')
             
              ->add('roles', 'choice', array('choices' => 
                array(
                    'ROLE_Client' => 'ROLE_Client',
                    'ROLE_Admin' => 'ROLE_Admin',
                
                ),
                'required'  => true,
                'multiple' => true
            ))
       
                 ->add('nom')               
        
            ->add('prenom')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\AdminBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_adminbundle_user';
    }
}
