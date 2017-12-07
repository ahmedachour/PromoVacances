<?php

namespace Gestion\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\AdminBundle\Entity\User;
use Gestion\AdminBundle\Form\UserType;
use Gestion\AdminBundle\Entity\reservation;
use Gestion\AdminBundle\Form\reservationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
/**
 * reservation controller.
 *
 */
class reservationController extends Controller
{

    /**
     * Lists all reservation entities.
     *
     */
   
    
    
   
    
    public function menu1Action() {
 
 if (isset($_COOKIE['cookie_name']))
     $articles= $_COOKIE['cookie_name'];
    else 
        $articles=0;
    
    
    if (true === $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
         $userid = $this->get('security.context')->getToken()->getUser()->getId();
          
         $sqlnb = "select  sum(nbre_pers_reserve) as nbre_persreserve from  admin_promovacancs.reservation  where  user_id=" . $userid . " and etat_valid='0'";
       // echo $sqlnb;
        $emnb = $this->getDoctrine()->getEntityManager();
        $stmtnb = $emnb->getConnection()->prepare($sqlnb);
        $stmtnb->execute();
        $req= $stmtnb->fetchAll();
         foreach ($req as $row1) {
                $nbre_persreserve = $row1['nbre_persreserve'];



                if (!empty($_POST[$nbre_persreserve])) {
                    $nbre_persreserve = $_POST[$nbre_persreserve];
                }
            }
        
           if($nbre_persreserve!=0)
           {
                $articles=$nbre_persreserve; 
           }
           else
           {
                  $articles=0;
           }
    }
    
    
        return $this->render('GestionAdminBundle::menu1.html.twig', array('articles' => $articles));
    }
   
  
      public function validerAction(Request $Request) {
        $Request = $this->getRequest();
        if ($Request->getMethod() == 'POST') {
            $id= $Request->get("id"); 
            $nbre_pers = $Request->get("nbre_pers");
   
              $idpack= $Request->get("idpack");
          
        }
  
   
         $_SESSION['test'] = $idpack;
         $test= $_SESSION['test'];
         setcookie('cookie_name', $test, time() +360, "/");
   
        
        
                $userid = $this->get('security.context')->getToken()->getUser()->getId(); 
               // echo $userid;
                     
            $sql23 = "select  MAX(id) as id from admin_promovacancs.reservation LIMIT 1";
            //echo $sql23;
            $em23 = $this->getDoctrine()->getEntityManager();
            $stmt23 = $em23->getConnection()->prepare($sql23);
            $stmt23->execute();
            $entities23 = $stmt23->fetchAll();


            foreach ($entities23 as $row1) {
                $id1 = $row1['id']+1;



                if (!empty($_POST[$id1])) {
                    $id1 = $_POST[$id1] ;
                    
                }
            }
        
                        $sqlp = "select  prix from admin_promovacancs.package where   idpack='" . $idpack . "'";
                      //  echo $sqlp;
                        $emp = $this->getDoctrine()->getEntityManager();
                        $stmtp = $emp->getConnection()->prepare($sqlp);
                        $stmtp->execute();
                        $entitiesp = $stmtp->fetchAll();


                        foreach ($entitiesp as $rowp) {
                            $prix = $rowp['prix'];
                           

                           
                        }
                    
                     if (!empty($_POST[$prix])) {
                                $prix = $_POST[$prix];
                            }
            
  if ($Request->getMethod() == 'POST'  ) {
    
            $id= $Request->get("id"); 
            $nbre_pers = $Request->get("nbre_pers");
          
  
                      $idpack= $Request->get("idpack");
  $size =8;

$string = strtoupper(substr(md5(time().rand(10000,99999)), 0, $size));
//echo $string;
            $sql2 = "insert into admin_promovacancs.reservation "
                    . " values(" . $id1 . "," . $nbre_pers . "," . $prix . ",'0'," . $id . "," . $userid . "," . $prix . ",'0'," . $idpack. ",'".$string."') ";
 
            $em2 = $this->getDoctrine()->getEntityManager();
            $stmt2 = $em2->getConnection()->prepare($sql2);
            $stmt2->execute();
           
       return $this->redirect($this->generateUrl('payment')); 
                   
                
  }
               
           
               
               
      
            
        
        return $this->render('GestionAdminBundle:Offre:insecription.html.twig',array('id' => $id,
                    'nbre_pers' => $nbre_pers,'idpack' => $idpack
                  
                ));
   
    }  
    
    
       public function suppreservationAction($id) {
        
            $sql3= " DELETE  from admin_promovacancs.reservation where id='".$id."'";    
               
                        $em2 = $this->getDoctrine()->getEntityManager();
                        $stmt2 = $em2->getConnection()->prepare($sql3);
                        $stmt2->execute();
 
        
        $this->get('session')->getFlashBag()->add('notice', " Prix est bien supprimer ");
        /* ... et on redirige vers la page d'administration des genres */
        return $this->redirect($this->generateUrl('payment'));
    }
    
    
       public function confirmationAction() {
 
        $sql = "select r.*.u.*,o.* from admin_promovacancs.reservation r,admin_promovacancs.user u,admin_promovacancs.offre o,admin_promovacancs.package p"
                . " where u.id=r.user_id and p.idpack=r.package_idpack and o.id=r.offre_id and  r.etat_valid=1 and r.etat_payment=0 ";
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();
 
        return $this->render('GestionAdminBundle:Offre:confirmation.html.twig', array(
                    'entities' => $entities,
                  
        ));
       }
    
}
