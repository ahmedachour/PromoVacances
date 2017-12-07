<?php

namespace Gestion\AdminBundle\Controller;

use Gestion\AdminBundle\Entity\Imageoffre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
 
use Gestion\AdminBundle\Form\ImageoffreType;
use Doctrine\ORM\EntityRepository;
/**
 * Imageoffre controller.
 *
 */
class ImageoffreController extends Controller
{
   public function imageoffreAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $hot = $em->getRepository('GestionAdminBundle:Imageoffre')->find($id);
        $entity = $em->getRepository('GestionAdminBundle:Imageoffre')->findbyid($id);

        return $this->render('GestionAdminBundle:Imageoffre:imageoffre.html.twig', array(
                    'entity' => $entity,
                    'hot' => $hot,
        ));
    }

    public function ajouterAction(Request $request, $id) {
        $p = new Imageoffre();

        $form = $this->createForm(new ImageoffreType(), $p)
                ->add('image', 'file')
                ->add('etat')
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


                $p->uploadImage();
                $em->persist($p);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', " Image Offre est bien saisie ");
                return $this->redirect($this->generateUrl('offre_listeoffre'));
            }
        }


        return $this->render('GestionAdminBundle:Imageoffre:ajouter.html.twig', array('form' => $form->createView()));
    }

    public function supprimerimageoffreAction($id) {
          $sql3= " DELETE  from imageoffre where id='".$id."'";    
               
                        $em2 = $this->getDoctrine()->getEntityManager();
                        $stmt2 = $em2->getConnection()->prepare($sql3);
                        $stmt2->execute();
 
        $this->get('session')->getFlashBag()->add('notice', " Image est bien supprimer ");
        /* ... et on redirige vers la page d'administration des genres */
        return $this->redirect($this->generateUrl('offre_listeoffre'));
    }

    public function boutonActiveAction($id) {

 
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository("GestionAdminBundle:Imageoffre")->findOneById($id); // id 1 already exists in the database, I just want to update this row



 

        if ($entities->getEtat() == 1) {
            $entities->setEtat(0);
            $em->merge($entities);
        } else {
            $entities->setEtat(1);
            $em->merge($entities);
        }
        $em->flush();

 
        return $this->redirect($this->generateUrl('offre_listeoffre'));
    }
}
