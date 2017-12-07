<?php

namespace Gestion\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\AdminBundle\Entity\Package;
use Gestion\AdminBundle\Form\PackageType;
use Doctrine\ORM\EntityRepository;

/**
 * Package controller.
 *
 */
class PackageController extends Controller
{

    /**
     * Lists all Package entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionAdminBundle:Package')->findAll();

        return $this->render('GestionAdminBundle:Package:index.html.twig', array(
            'entities' => $entities,
        ));
    }
      public function ajouterAction($id) {
        $p = new Package();

        $form = $this->createForm(new PackageType(), $p)
              ->add('prix')
            ->add('ancienPrix')
                  ->add('etatp', 'text', array('attr' => array('class' => 'form-control'),'required' => false))
                   ->add('pack')
                ->add('offre', 'entity', array(
            'class' => 'GestionAdminBundle:offre',
            'query_builder' => function(EntityRepository $er)use($id) {

        return $er->createQueryBuilder('u')
                ->where('u.id=' . $id);
    }))

        ;

        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $p = $form->getData();


                $em->persist($p);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notic1', "package bien saisie ");
    
       return $this->redirect($this->generateUrl('offre_listeoffre'));
            }
        }

             
   $sql = "select p.* from admin_promovacancs.offre t ,admin_promovacancs.package p where t.id=p.offre_id and t.id='".$id."' ";
  // echo $sql;
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();
        
        return $this->render('GestionAdminBundle:Package:ajouter.html.twig', array('entities' => $entities,'form' => $form->createView()));
    }

    
      public function modifierAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $p = $em->getRepository('GestionAdminBundle:package')->findOneById($id);

        $form = $this->createForm(new PackageType(), $p);

        $request = $this->getRequest();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->merge($p);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', "  package  est bien Modifier ");
                return $this->redirect($this->generateUrl('package'));
            }
        }
        return $this->render('GestionAdminBundle:Package:modifier.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
    
      public function supppackageAction($id) {
        
            $sql3= " DELETE  from admin_promovacancs.package where idpack='".$id."'";    
               
                        $em2 = $this->getDoctrine()->getEntityManager();
                        $stmt2 = $em2->getConnection()->prepare($sql3);
                        $stmt2->execute();
 
        
        $this->get('session')->getFlashBag()->add('notice', " package  est bien supprimer ");
        /* ... et on redirige vers la page d'administration des genres */
        return $this->redirect($this->generateUrl('offre_listeoffre'));
    }
    
}
