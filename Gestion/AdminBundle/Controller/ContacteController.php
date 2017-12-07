<?php

namespace Gestion\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\AdminBundle\Entity\Contacte;
use Gestion\AdminBundle\Form\ContacteType;

/**
 * Contacte controller.
 *
 */
class ContacteController extends Controller
{

    /**
     * Lists all Contacte entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionAdminBundle:Contacte')->findAll();

        return $this->render('GestionAdminBundle:Contacte:index.html.twig', array(
            'entities' => $entities,
        ));
    }
 
    
    
      public function ajouterAction() {
        $p = new Contacte();

        $form = $this->createForm(new  ContacteType(), $p);

        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $p = $form->getData();
               

                    $em->persist($p);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', " Contacte bien saisie ");
                     
                 
            }
        }


        return $this->render('GestionAdminBundle:Contacte:ajouter.html.twig', array('form' => $form->createView()));
    }
 
    public function suppprodAction($id) {
        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->getDoctrine()->getManager();

        /* On récupère l'entité à supprimer */
        $img = $em->getRepository("GestionAdminBundle:Contacte")->findOneBy(array('id' => $id));


        /* Enfin on supprime le genre ... */
        $em->remove($img);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', " Omera est bien supprimer ");
        /* ... et on redirige vers la page d'administration des genres */
        return $this->redirect($this->generateUrl('contacte'));
    }
}
