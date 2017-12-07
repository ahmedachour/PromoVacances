<?php

namespace Gestion\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class Offre2Type extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('nom')
           ->add('adresse')
           ->add('telephone','text', array(   'attr' => array('placeholder' => 'Telephone'   ),'max_length' => 8, 'label' => false, 'required' => true))    
            ->add('dateOffre')
            ->add('dateDebut', 'date', array(
    'widget' => 'single_text',
    'format' => 'yyyy-MM-dd'
))
     
            ->add('dateFin', 'date', array(
    'widget' => 'single_text',
    'format' => 'yyyy-MM-dd'
))
     
            ->add('etatOffre')
            ->add('description','textarea',array('attr'=>array('class'=>'ckeditor')))
            ->add('typeOffre')
            ->add('region', 'choice', array(
                    'required' => true,
                    'empty_value' => '== choisir un offre ==',
                    'multiple' => false,
                    'choices' => array('Toutes les régions' => 'Toutes les régions', 'NORD' => 'NORD',
                        'NORD OUEST' => 'NORD OUEST', 'CAP BON' => 'CAP BON'
                        ,  'SAHEL' => 'SAHEL',  'CENTRE' => 'CENTRE'
                        ,  'SUD' => 'SUD',  'SUD SAHARIEN' => 'SUD SAHARIEN',  'LES ILES TUNISIENNE' => 'LES ILES TUNISIENNE')))
                
            ->add('ville', 'choice', array(
                    'required' => true,
                    'empty_value' => '== choisir un offre ==',
                    'multiple' => false,
                    'choices' => array('Ville' => 'Ville', 'AIN DRAHEM' => 'AIN DRAHEM',
                        'BEJA' => 'BEJA', 'BIZERTE' => 'BIZERTE'
                        ,  'DJERBA' => 'DJERBA',  'DOUZ' => 'DOUZ'
                         ,  'GABES' => 'GABES',  'GAFSA' => 'GAFSA'
                         ,  'HAMMAM BOURGUIBA' => 'HAMMAM BOURGUIBA',  'HAMMAM SOUSSE' => 'HAMMAM SOUSSE'
                         ,  'HAMMAMET' => 'HAMMAMET',  'JENDOUBA' => 'JENDOUBA'
                         ,  'KAIROUAN' => 'KAIROUAN',  'KEBILI' => 'KEBILI'
                        ,  'KERKENNAH' => 'KERKENNAH',  'KLEBIA' => 'KLEBIA',  
                        'KORBA' => 'KORBA','KORBUS' => 'KORBUS'
                        ,'LE KEF' => 'LE KEF'
                        ,'MAHDIA' => 'MAHDIA','MAKTHAR' => 'MAKTHAR'
                        ,'MEDNINE ' => 'MEDNINE ','MATMATA' => 'MATMATA'
                        ,'MONASTIR' => 'MONASTIR','NABEUL' => 'NABEUL'
                        ,'SFAX' => 'SFAX','SOUSSE' => 'SOUSSE'
                        ,'TABARKA' => 'TABARKA','TATAOUINE' => 'TATAOUINE'
                        ,'TOUZEUR' => 'TOUZEUR','TUNIS' => 'TUNIS'
                        ,'ZARZIS' => 'ZARZIS','ZONE TOURISTIQUE' => 'ZONE TOURISTIQUE'
                        
                        
                        )))
                
                  ->add('tripadivisor','textarea')
            ->add('maps','textarea')
            ->add('nbrePers')
            ->add('etat')
            ->add('reduction')
            ->add('description2','textarea',array('attr'=>array('class'=>'ckeditor')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\AdminBundle\Entity\Offre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_adminbundle_offre';
    }
}
