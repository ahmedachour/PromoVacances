<?php

namespace Gestion\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\AdminBundle\Entity\User;
use Gestion\AdminBundle\Form\UserType;
use Gestion\AdminBundle\Form\User1Type;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\SecurityContext;
/**
 * User controller.
 *
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionAdminBundle:user')->findAll();

        return $this->render('GestionAdminBundle:User:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionAdminBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionAdminBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionAdminBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionAdminBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionAdminBundle:user')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('GestionAdminBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionAdminBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
        public function insecriptionuserAction()
    {
         $p = new User();
   
        $form = $this->createForm( new UserType(),$p);
        
        $em = $this->getDoctrine()->getEntityManager();
         $request = $this->getRequest();
  
    if ('POST' == $request->getMethod()) {
      $form->handleRequest($request); 
      if ($form->isValid()) {
      $p = $form ->getData();
        $username = $p->getusername() ;
         $useremail = $p->getemail() ;
        $chercherusername = $em->getRepository('GestionAdminBundle:user')->findOneBy(array('username'=>$username));
         $chercheruseremail = $em->getRepository('GestionAdminBundle:user')->findOneBy(array('email'=>$useremail));
         if((empty($chercherusername)==true) and (empty($chercheruseremail)==true) ){
            
             $em->persist($p);
             $em->flush();
               $this->get('session')->getFlashBag()->add('notice', "Utilisateur est bien saisie ");
                   return $this->redirect($this->generateUrl('connexion'));
        
         }else if ((empty($chercherusername)==false)and (empty($chercheruseremail)==false))   {
                 $this->get('session')->getFlashBag()->add('notice', " Le Utilisateur existe déja ");
         }
    }}
            
        
        return $this->render('GestionAdminBundle:User:insecriptionuser.html.twig',array('form' => $form ->createView()));
   
    }
    
    
    
     public function modifierAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager() ;
       $user= $em->getRepository('GestionAdminBundle:user')->findOneById($id);
       
         $form = $this->createForm( new User1Type(),$user);
          
         $request = $this->getRequest();
         
         if( $request->isMethod('POST')){
             $form->handleRequest($request);
             
             if($form->isValid()){
             $em->merge($user);
             $em->flush();
     $this->get('session')->getFlashBag()->add('notice', "  Utilisateur est bien Modifier ");
            return $this->redirect($this->generateUrl('user'));
            }
         }
        return $this->render('GestionAdminBundle:User:modifier.html.twig', array(
            
            'form' => $form ->createView(),
        ));
    }
    
    
       public function suppprodAction($id) {
    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
     $em = $this->getDoctrine()->getManager();
 
    /* On récupère l'entité à supprimer */
    $img = $em->getRepository("GestionAdminBundle:user")->findOneBy(array('id' => $id));
    
 
    /* Enfin on supprime le genre ... */
    $em->remove($img);
    $em->flush();
      $this->get('session')->getFlashBag()->add('notice', " Utilisateur est bien supprimer ");
    /* ... et on redirige vers la page d'administration des genres */
    return $this->redirect($this->generateUrl('user'));
}
      public function modifieruserAction($id)
    {
         $id = $this->get('security.context')->getToken()->getUser()->getId(); 
        $em = $this->getDoctrine()->getEntityManager() ;
       $user= $em->getRepository('GestionAdminBundle:user')->findOneById($id);
       
         $form = $this->createForm( new User2Type(),$user);
          
         $request = $this->getRequest();
         
         if( $request->isMethod('POST')){
             $form->handleRequest($request);
             
             if($form->isValid()){
             $em->merge($user);
             $em->flush();
     $this->get('session')->getFlashBag()->add('notice', "Utilisateur est bien Modifier ");
            return $this->redirect($this->generateUrl('user'));
            }
         }
        return $this->render('GestionAdminBundle:User:modifieruser.html.twig', array(
            
            'form' => $form ->createView(),
        ));
    }
    
          public function boutonActiveAction($id){
       
$em = $this->getDoctrine()->getEntityManager() ;
$entities = $em->getRepository("GestionAdminBundle:user")->findOneById($id); // id 1 already exists in the database, I just want to update this row





if($entities->getEnabled() == 1) {
$entities->setEnabled(0);
$em->merge($entities);

}else{
 $entities->setEnabled(1);
$em->merge($entities);
}
$em->flush();

 
 return $this->redirect($this->generateUrl('user'));
     }
     
     
       public function applicationAction()
    {
         

        return $this->render('GestionAdminBundle:User:application.html.twig');
         
    }
    
      
    public function connexionAction(Request $request) {
      
        
        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        
        
        
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);
          
          
        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
          
           
    
        
              return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ));
   }


    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {
        $template = sprintf('GestionAdminBundle:User:connexion.html.%s', $this->container->getParameter('fos_user.template.engine'));

        return $this->container->get('templating')->renderResponse($template, $data);
        
    }

    public function checkAction()
    {
                    return $this->render('GestionAdminBundle:Hotel:suppprod..html.twig'); 

        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    } 
    

    
    
    
}
