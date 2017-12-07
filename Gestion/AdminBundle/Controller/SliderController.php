<?php

namespace Gestion\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\AdminBundle\Entity\Slider;
use Gestion\AdminBundle\Form\SliderType;
use Symfony\Component\HttpFoundation\Response;
/**
 * Slider controller.
 *
 */
class SliderController extends Controller
{

    /**
     * Lists all Slider entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionAdminBundle:Slider')->findAll();

        return $this->render('GestionAdminBundle:Slider:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    
   
    
    
     public function ActiveAction($id) {

 
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository("GestionAdminBundle:Slider")->findOneById($id); // id 1 already exists in the database, I just want to update this row


 
        if ($entities->getEtat() == 1) {
            $entities->setEtat(0);
            $em->merge($entities);
        } else {
            $entities->setEtat(1);
            $em->merge($entities);
        }
        $em->flush();

 

        return $this->redirect($this->generateUrl('slider'));
    }
    
    
    
    
    
    
     public function ajouterAction() {
        $p = new Slider();
 
 $form = $this->createForm(new SliderType(), $p);

        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $p = $form->getData();


                $p->uploadImage();
                $em->persist($p);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', " Slider est bien saisie ");
                return $this->redirect($this->generateUrl('slider'));
            }
        }


        return $this->render('GestionAdminBundle:Slider:ajouter.html.twig', array('form' => $form->createView()));
    }

    public function supprimersliderAction($id) {
        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->getDoctrine()->getManager();

        /* On récupère l'entité à supprimer */
        $img = $em->getRepository("GestionAdminBundle:Slider")->findOneBy(array('id' => $id));


        /* Enfin on supprime le genre ... */
        $em->remove($img);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', " Slider est bien supprimer ");
        /* ... et on redirige vers la page d'administration des genres */
        return $this->redirect($this->generateUrl('slider'));
    }

    public function slidersAction() {
 
        $sql = "select t.* from slider t";
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();
 
        return $this->render('GestionAdminBundle:Slider:sliders.html.twig', array(
                    'entities' => $entities,
                  
        ));
        
        
        
        
        
    }
    
}
