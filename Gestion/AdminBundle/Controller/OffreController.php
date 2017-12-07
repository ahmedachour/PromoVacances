<?php

namespace Gestion\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\AdminBundle\Entity\User;
  
use Gestion\AdminBundle\Entity\PrixpayementRepository;
use Gestion\AdminBundle\Entity\Prixpayement;
use Gestion\AdminBundle\Form\UserType;
use Gestion\AdminBundle\Entity\Offre;
use Gestion\AdminBundle\Form\OffreType;
use Gestion\AdminBundle\Form\Offre1Type;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * Offre controller.
 *
 */
class OffreController extends Controller {

    /**
     * Lists all Offre entities.
     *
     */
    public function  factureAction()
    {//on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
		$html = $this -> render('GestionAdminBundle:Offre:facture.html.twig');
	//le sens de la page "portrait" => p ou "paysage" => l
		//le format A4,A5...
		//la langue du document fr,en,it...
		$html2pdf = $this -> get('html2pdf_factory') -> create();
		$html2pdf = $this -> get('html2pdf_factory') -> create('P', 'A4', 'fr', true, 'UTF-8', array(10, 15, 10, 15));
		//SetDisplayMode définit la manière dont le document PDF va être affiché par l’utilisateur
		//fullpage : affiche la page entière sur l'écran
		//fullwidth : utilise la largeur maximum de la fenêtre
		//real : utilise la taille réelle
		$html2pdf -> pdf -> SetDisplayMode('real');
		//writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
		$html2pdf -> writeHTML($html);
		//Output envoit le document PDF au navigateur internet avec un nom spécifique qui aura un rapport avec le contenu à convertir (exemple : Facture, Règlement…)
		$html2pdf -> Output('Factureyy.pdf'); 
                
                
                
		return new Response();
    }
    public function ajouterAction() {
        $p = new Offre();

        $form = $this->createForm(new OffreType(), $p);

        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $p = $form->getData();

                $p->uploadImage();
                $em->persist($p);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notic1', "Offre bien saisie ");
                return $this->redirect($this->generateUrl('offre_listeoffre'));
            }
        }


        return $this->render('GestionAdminBundle:Offre:ajouter.html.twig', array('form' => $form->createView()));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $offre = $em->getRepository('GestionAdminBundle:offre')->findOneById($id);

        $form = $this->createForm(new OffreType(), $offre);


        $sql1 = "select o.* from admin_promovacancs.offre o   where "
                . " o.id=" . $id . " ";

        $em1 = $this->getDoctrine()->getEntityManager();
        $stmt1 = $em1->getConnection()->prepare($sql1);
        $stmt1->execute();
        $entities1 = $stmt1->fetchAll();

        $request = $this->getRequest();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
              
                      
                $em->merge($offre);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', "  Offre est bien Modifier ");
                return $this->redirect($this->generateUrl('offre_listeoffre'));
            }
        }
        return $this->render('GestionAdminBundle:Offre:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'entities1' => $entities1,
        ));
    }

    
    
    
     public function modifierimageAction($id) {
        
          $em = $this->getDoctrine()->getEntityManager();
        $offre = $em->getRepository('GestionAdminBundle:offre')->findOneById($id);
      
        $form = $this->createForm(new Offre1Type(), $offre);

 
        $request = $this->getRequest();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
              
                $em->merge($offre);
                
                 $offre->uploadImage();
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', "  Offre est bien Modifier ");
                return $this->redirect($this->generateUrl('offre_listeoffre'));
            }
        }
        return $this->render('GestionAdminBundle:Offre:modifierimage.html.twig', array(
                    'form' => $form->createView(),
               
        ));
    }
    
    
    
    public function supppAction($id) {

        $sql3 = " DELETE  from admin_promovacancs.offre where id='" . $id . "'";

        $em2 = $this->getDoctrine()->getEntityManager();
        $stmt2 = $em2->getConnection()->prepare($sql3);
        $stmt2->execute();


        $this->get('session')->getFlashBag()->add('notice', " Offre est bien supprimer ");
        /* ... et on redirige vers la page d'administration des genres */
        return $this->redirect($this->generateUrl('offre_listeoffre'));
    }

    public function ActiveAction($id) {


        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository("GestionAdminBundle:offre")->findOneById($id); // id 1 already exists in the database, I just want to update this row

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

    public function listeoffreAction() {


        $sql = "select t.* from admin_promovacancs.offre t  ";
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();

        return $this->render('GestionAdminBundle:Offre:listeoffre.html.twig', array(
                    'entities' => $entities,
        ));
    }

    public function detailoffreAction($id) {


        $sql = "select t.*   from admin_promovacancs.offre t ,admin_promovacancs.package p where  p.offre_id=t.id and t.id=" . $id . " group by t.id ";


        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();

        $sql2 = "select p.*   from admin_promovacancs.offre t ,admin_promovacancs.package p where  p.offre_id=t.id and t.id=" . $id . " ";


        $em2 = $this->getDoctrine()->getEntityManager();
        $stmt2 = $em2->getConnection()->prepare($sql2);
        $stmt2->execute();
        $entities2 = $stmt2->fetchAll();

        $sql1 = "select i.* from  admin_promovacancs.imageoffre i ,admin_promovacancs.offre t where  t.id=i.offre_id and  t.id='" . $id . "' ";
        $em1 = $this->getDoctrine()->getEntityManager();
        $stmt1 = $em1->getConnection()->prepare($sql1);
        $stmt1->execute();
        $entities1 = $stmt1->fetchAll();

        return $this->render('GestionAdminBundle:Offre:detailoffre.html.twig', array(
                    'entities' => $entities,
                    'entities2' => $entities2,
                    'entities1' => $entities1,
        ));
    }

    public function detailAction($id) {


        $sql = "select t.* from admin_promovacancs.offre t where t.id='" . $id . "' ";
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();


        return $this->render('GestionAdminBundle:Offre:detail.html.twig', array(
                    'entities' => $entities,
        ));
    }

    public function paymentAction(Request $request) {
    if (true === $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

        $userid = $this->get('security.context')->getToken()->getUser()->getId();
      
   
        $session = $this->getRequest()->getSession();
        $id = "";
        $prix = "";

        $panier = "";

        
        if (!empty($_POST["prix"])) {
            $prix = $_POST["prix"];
        }

        if (!empty($_POST["prix"])) {
            $prix = $_POST["prix"];
        }


        if (!empty($_POST["panier1"])) {
            $panier1 = array();
            $panier1 = $_POST["panier1"];

           // echo var_dump($panier1);
        }

        if (!$session->has('panier'))
            $session->set('panier', array());
        $panier = $session->get('panier');
        if ($request->isMethod('POST')) {


            /*
             * 
             *   $sql4 = "select  r.* from reservation where    r.id=" . $key . "";

              $em4 = $this->getDoctrine()->getEntityManager();
              $stmt4 = $em4->getConnection()->prepare($sql4);
              $stmt4->execute();
              $entities4 = $stmt4->fetchAll();
              foreach ($entities as $row1) {
              $ville = $row1['ville'];

              }



              foreach ($panier1 as $key => $value) {


              $sql4 = "select  prix from reservation where     id=" . $key . "";




              $em4 = $this->getDoctrine()->getEntityManager();
              $stmt4 = $em4->getConnection()->prepare($sql4);
              $stmt4->execute();
              $entities4 = $stmt4->fetchAll();
              foreach ($entities4 as $row1) {
              $prix = $row1['prix'];

              }


              }
             */

            foreach ($panier1 as $key => $value) {

                $sql3 = "  update admin_promovacancs.reservation   set   nbre_pers_reserve=" . $value . " "
                        . " where  id=" . $key . "";

                $em2 = $this->getDoctrine()->getEntityManager();
                $stmt2 = $em2->getConnection()->prepare($sql3);
                $stmt2->execute();
            }



            foreach ($panier1 as $key => $value) {


                $sql4 = "select  prix from admin_promovacancs.reservation where     id=" . $key . "";
                $em4 = $this->getDoctrine()->getEntityManager();
                $stmt4 = $em4->getConnection()->prepare($sql4);
                $stmt4->execute();
                $entities4 = $stmt4->fetchAll();
                foreach ($entities4 as $row1) {
                    $prix = $row1['prix'];
                    $somme = $prix * $value;
                  //  echo $somme;

                    $sql31 = "  update admin_promovacancs.reservation   set  prix_total=" . $somme . " "
                            . " where  id=" . $key . "";

                    $em21 = $this->getDoctrine()->getEntityManager();
                    $stmt21 = $em21->getConnection()->prepare($sql31);
                    $stmt21->execute();
                }
            }
        }

        $sqlnb = "select  sum(nbre_pers_reserve) as nbre_persreserve from  admin_promovacancs.reservation  where  user_id=" . $userid . " and etat_valid='0'";
       // echo $sqlnb;
        $emnb = $this->getDoctrine()->getEntityManager();
        $stmtnb = $emnb->getConnection()->prepare($sqlnb);
        $stmtnb->execute();
        $entitiesnb = $stmtnb->fetchAll();

        $sqltt = "select  sum(prix_total) as TOTAL_MONTANT  from  admin_promovacancs.reservation  where  user_id=" . $userid . " and etat_valid='0'";
        //echo $sqltt;
        $emtt = $this->getDoctrine()->getEntityManager();
        $stmttt = $emtt->getConnection()->prepare($sqltt);
        $stmttt->execute();
        $entitiestt = $stmttt->fetchAll();

        foreach ($entitiestt as $row1) {
            $TOTAL_MONTANT = $row1['TOTAL_MONTANT'];
        }



        $sqlr = "select  sum(nbre_pers_reserve) as nbre_pers_reserve  from  admin_promovacancs.reservation  where  user_id=" . $userid . " and etat_valid='0'";
        //echo $sqlr;
        $emr = $this->getDoctrine()->getEntityManager();
        $stmtr = $emr->getConnection()->prepare($sqlr);
        $stmtr->execute();
        $entitiesr = $stmttt->fetchAll();

        foreach ($entitiesr as $row1) {
            $nbre_pers_reserve = $row1['nbre_pers_reserve'];
        }

        $sql = "select t.*,r.*,p.* from admin_promovacancs.offre t,admin_promovacancs.reservation r,admin_promovacancs.package p where r.offre_id=t.id and p.idpack=r.package_idpack and r.user_id=" . $userid . " and r.etat_valid=0 ";

        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();

        $size = 8;

        $string = strtoupper(substr(md5(time() . rand(10000, 99999)), 0, $size));
       // echo $string;

        return $this->render('GestionAdminBundle:Offre:payment.html.twig', array(
                    'entities' => $entities, 'entitiestt' => $entitiestt, 'entitiesnb' => $entitiesnb,
        ));
         }
         else
         {
              return $this->redirect($this->generateUrl('login'));   
         }
    }

    public function confirmationAction(Request $Request) {
        $Request = $this->getRequest();
        $userid = $this->get('security.context')->getToken()->getUser()->getId();
        $session = $this->getRequest()->getSession();

        $sql3 = "  update admin_promovacancs.reservation   set   etat_valid=1 "
                . " where  user_id=" . $userid . "";

        $em2 = $this->getDoctrine()->getEntityManager();
        $stmt2 = $em2->getConnection()->prepare($sql3);
        $stmt2->execute();


        if ($Request->getMethod() == 'POST') {

            $sql23 = "select  MAX(id) as id from admin_promovacancs.prixpayement LIMIT 1";
           // echo $sql23;
            $em23 = $this->getDoctrine()->getEntityManager();
            $stmt23 = $em23->getConnection()->prepare($sql23);
            $stmt23->execute();
            $entities23 = $stmt23->fetchAll();


            foreach ($entities23 as $row1) {
                $id1 = $row1['id'] + 1;



                if (!empty($_POST[$id1])) {
                    $id1 = $_POST[$id1];
                }
            }
        }


        if ($Request->getMethod() == 'POST') {

            $ptixtotal = $Request->get("ptixtotal");
            $nbre = $Request->get("nbre");

            $ran = $Request->get("ran");

            $sql2 = "insert into admin_promovacancs.prixpayement "
                    . " values(" . $id1 . "," . $userid . "," . $ptixtotal . ",'1'," . $nbre . ",'0'," . $ran . ") ";

            $em2 = $this->getDoctrine()->getEntityManager();
            $stmt2 = $em2->getConnection()->prepare($sql2);
            $stmt2->execute();
            return $this->redirect($this->generateUrl('login'));
        }



        return $this->render('GestionAdminBundle:Offre:confirmation.html.twig');
    }

    public function paymentupdateAction(Request $request) {
        $userid = $this->get('security.context')->getToken()->getUser()->getId();
        $Request = $this->getRequest();
        $id = "";
        $prix = "";
        $nbre_pers = "";
        $panier = "";

        if (!empty($_POST["prix"])) {
            $prix = $_POST["prix"];
        }
        if (!empty($_POST["nbre_pers"])) {
            $nbre_pers = $_POST["nbre_pers"];
        }
        if (!empty($_POST["prix"])) {
            $prix = $_POST["prix"];
        }
        if (!empty($_POST["panier"])) {
            $panier = $_POST["panier"];
           // echo print_r($panier);
          //  echo var_dump($panier);
        }



        foreach ($panier as $key => $value) {
            $t = $panier[$key];
            $sql = "select * from admin_promovacancs.reservation where id=" . $t . "";

            $somme = $prix * $nbre_pers;
            $sql3 = "  update admin_promovacancs.reservation   set  prix_total=" . $somme . ",nbre_pers_reserve=" . $nbre_pers . " "
                    . " where  id=" . $t . "";
           // echo $sql3;
        }

        $em2 = $this->getDoctrine()->getEntityManager();
        $stmt2 = $em2->getConnection()->prepare($sql3);
        $stmt2->execute();



        $sql = "select t.*,r.* from admin_promovacancs.offre t,admin_promovacancs.reservation r where r.offre_id=t.id  and r.user_id=" . $userid . "  and r.etat_valid=0";
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();


        return $this->render('GestionAdminBundle:Offre:paymentupdate.html.twig', array(
                    'entities' => $entities,
        ));
    }

    public function insecriptionAction(Request $Request) {
        $Request = $this->getRequest();
        
        if ($Request->getMethod() == 'POST') {
            $id = $Request->get("id");
            $nbre_pers = $Request->get("nbre_pers");

            $idpack = $Request->get("idpack");
        }
          $_SESSION['test'] = $idpack;
        
         $test= $_SESSION['test'];
         setcookie('cookie_name', $test, time() +360, "/");
         
        $p = new User();

        $form = $this->createForm(new UserType(), $p);

        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $p = $form->getData();
                $username = $p->getusername();
                $useremail = $p->getemail();
                $chercherusername = $em->getRepository('GestionAdminBundle:User')->findOneBy(array('username' => $username));
                $chercheruseremail = $em->getRepository('GestionAdminBundle:User')->findOneBy(array('email' => $useremail));
                if ((empty($chercherusername) == true) and (empty($chercheruseremail) == true)) {

                    $em->persist($p);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', "Utilisateur est bien saisie ");




                    if ($request->getMethod() == 'POST') {

                        $sql2 = "select  id from admin_promovacancs.user where   email='" . $useremail . "'";
                        //echo $sql2;
                        $em2 = $this->getDoctrine()->getEntityManager();
                        $stmt2 = $em2->getConnection()->prepare($sql2);
                        $stmt2->execute();
                        $entities2 = $stmt2->fetchAll();


                        foreach ($entities2 as $row1) {
                            $id2 = $row1['id'];



                            if (!empty($_POST[$id2])) {
                                $id2 = $_POST[$id2];
                            }
                        }
                    }


                    $sqlp = "select  *  from admin_promovacancs.package where   idpack='" . $idpack . "'";

                    $emp = $this->getDoctrine()->getEntityManager();
                    $stmtp = $emp->getConnection()->prepare($sqlp);
                    $stmtp->execute();
                    $entitiesp = $stmtp->fetchAll();


                    foreach ($entitiesp as $rowp) {
                        $prix = $rowp['prix'];
                        $prix = $rowp['prix'];

                        if (!empty($_POST[$prix])) {
                            $prix = $_POST[$prix];
                        }
                    }



                    if ($request->getMethod() == 'POST') {

                        $sql23 = "select  MAX(id) as id from admin_promovacancs.reservation LIMIT 1";
                       // echo $sql23;
                        $em23 = $this->getDoctrine()->getEntityManager();
                        $stmt23 = $em23->getConnection()->prepare($sql23);
                        $stmt23->execute();
                        $entities23 = $stmt23->fetchAll();


                        foreach ($entities23 as $row1) {
                            $id1 = $row1['id'] + 1;



                            if (!empty($_POST[$id1])) {
                                $id1 = $_POST[$id1];
                            }
                        }
                    }
                    if ($Request->getMethod() == 'POST') {
                        $size = 8;

                        $string = strtoupper(substr(md5(time() . rand(10000, 99999)), 0, $size));
                        //echo $string;
                        $id = $Request->get("id");
                        $nbre_pers = $Request->get("nbre_pers");

                        $idpack = $Request->get("idpack");

                        $sql2 = "insert into admin_promovacancs.reservation "
                                . " values(" . $id1 . "," . $nbre_pers . "," . $prix . ",'0'," . $id . "," . $id2 . "," . $prix . ",'0'," . $idpack . ",'" . $string . "') ";

                        $em2 = $this->getDoctrine()->getEntityManager();
                        $stmt2 = $em2->getConnection()->prepare($sql2);
                        $stmt2->execute();
                    }



                    return $this->redirect($this->generateUrl('login'));
                }
            }
        }


        return $this->render('GestionAdminBundle:Offre:insecription.html.twig', array('id' => $id,
                    'nbre_pers' => $nbre_pers, 'idpack' => $idpack,
                    'form' => $form->createView(),
        ));
    }

    public function paymentparbureauAction(Request $request) {


        $Request = $this->getRequest();
        $userid = $this->get('security.context')->getToken()->getUser()->getId();
        $session = $this->getRequest()->getSession();
        $id = "";


        if (!empty($_POST["ran"])) {
            $ran = $_POST["ran"];
        }
        $date1 = "";


        if (!empty($_POST["date1"])) {
            $date1 = $_POST["date1"];
        }

        $sql3 = "  update admin_promovacancs.reservation   set   etat_valid=1 "
                . " where  user_id=" . $userid . "";

        $em2 = $this->getDoctrine()->getEntityManager();
        $stmt2 = $em2->getConnection()->prepare($sql3);
        $stmt2->execute();


        if ($Request->getMethod() == 'POST') {

            $sql23 = "select  MAX(id) as id from admin_promovacancs.prixpayement LIMIT 1";
           // echo $sql23;
            $em23 = $this->getDoctrine()->getEntityManager();
            $stmt23 = $em23->getConnection()->prepare($sql23);
            $stmt23->execute();
            $entities23 = $stmt23->fetchAll();


            foreach ($entities23 as $row1) {
                $id1 = $row1['id'] + 1;



                if (!empty($_POST[$id1])) {
                    $id1 = $_POST[$id1];
                }
            }
        }


        if ($Request->getMethod() == 'POST') {

            $ptixtotal = $Request->get("ptixtotal");
            $nbre = $Request->get("nbre");

            $ran = $Request->get("ran");

            $sql2 = "insert into admin_promovacancs.prixpayement "
                    . " values(" . $id1 . "," . $userid . "," . $ptixtotal . ",'1'," . $nbre . ",'0'," . $ran . ",'Payer au bureau','" . $date1 . "') ";

            $em2 = $this->getDoctrine()->getEntityManager();
            $stmt2 = $em2->getConnection()->prepare($sql2);
            $stmt2->execute();
        }

        if (!empty($_POST["panierid"])) {
            $panierid = $_POST["panierid"];
          // echo print_r($panierid);
           //echo var_dump($panierid);
        }


   
          
        foreach ($panierid as $key => $value) {


           
            
            $sql3 = "insert into admin_promovacancs.commande_payement "
                          . " values(".$id1."," . $key . "," . $ran . "," . $value . ") ";
            $em3 = $this->getDoctrine()->getEntityManager();
            $stmt3 = $em3->getConnection()->prepare($sql3);
            $stmt3->execute();
            //echo $sql3;
        }




        return $this->redirect($this->generateUrl('payementvalider', array('ran' => $ran)));

        return $this->render('GestionAdminBundle:Offre:paymentparbureau.html.twig', array(
                    'ran' => $ran,
        ));
    }

    public function mescouponsAction(Request $request) {
   
   if (true === $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        $Request = $this->getRequest();
        $userid = $this->get('security.context')->getToken()->getUser()->getId();

        $sql = "select t.*  from admin_promovacancs.prixpayement t  where "
                . " t.user_id=" . $userid . " and t.flag_valid=1   ";
        //echo $sql;
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();




        return $this->render('GestionAdminBundle:Offre:mescoupons.html.twig', array(
                    'entities' => $entities,
        ));
         }
         else
         {
              return $this->redirect($this->generateUrl('login'));   
         }
    }

    public function detailmescouponsAction($coupon) {

 if (true === $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        $Request = $this->getRequest();
        $userid = $this->get('security.context')->getToken()->getUser()->getId();

        $sql = "select p.*,o.*  from admin_promovacancs.commande_payement cp,admin_promovacancs.package p,admin_promovacancs.offre o,admin_promovacancs.prixpayement pp     where "
                . "cp.prixpayement_id=pp.id   and o.id=p.offre_id and cp.idpack=p.idpack  and cp.coupon=" . $coupon . "  and pp.user_id=" . $userid . "  ";
       // echo $sql;
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();

        $sql1 = "select pp.* from admin_promovacancs.prixpayement pp   where "
                . "pp.coupon=" . $coupon . " and pp.user_id=" . $userid . " ";
      // echo $sql1;
        $em1 = $this->getDoctrine()->getEntityManager();
        $stmt1 = $em1->getConnection()->prepare($sql1);
        $stmt1->execute();
        $entities1 = $stmt1->fetchAll();








        return $this->render('GestionAdminBundle:Offre:detailmescoupons.html.twig', array(
                    'entities' => $entities,
                    'entities1' => $entities1,
        ));
         }
         else
         {
              return $this->redirect($this->generateUrl('login'));   
         }
    }

    public function payementvaliderAction(Request $request) {


        $Request = $this->getRequest();
        if (!empty($_GET["ran"])) {
            $ran = $_GET["ran"];
        }
       // echo $ran;




        return $this->render('GestionAdminBundle:Offre:payementvalider.html.twig', array(
                    'ran' => $ran,
        ));
    }
    
    
      public function listepayementbureauNonValiderAction() {

 
         
        $sql = "select  pp.* ,u.nom,u.prenom,u.username,u.teleph from admin_promovacancs.prixpayement pp,admin_promovacancs.user u where pp.user_id=u.id and pp.flag_valid=1  and pp.flag_payement=0 ";
  //echo $sql;
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();


        return $this->render('GestionAdminBundle:Offre:listepayementbureauNonValider.html.twig', array(
                    'entities' => $entities,
        ));
    }
    

       public function listepayementbureauValiderAction() {

 
         
        $sql = "select  pp.* ,u.nom,u.prenom,u.username,u.teleph from admin_promovacancs.prixpayement pp,admin_promovacancs.user u where pp.user_id=u.id and pp.flag_valid=1 and pp.mode_payement='Payer au bureau' and pp.flag_payement=1 ";
  
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();


        return $this->render('GestionAdminBundle:Offre:listepayementbureauValider.html.twig', array(
                    'entities' => $entities,
        ));
    }
    
    
       public function ActivepaymentAction($id) {

 
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository("GestionAdminBundle:prixpayement")->findOneById($id); // id 1 already exists in the database, I just want to update this row
 
 
 
        if ($entities->getFlagpayement() == 1) {
            $entities->setFlagpayement(0);
            $em->merge($entities);
        } else {
            $entities->setFlagpayement(1);
            $em->merge($entities);
        }
        $em->flush();

 
 return $this->redirect($this->generateUrl('listepayementbureauNonValider'
             
        ));
    }
           public function Activepayment3Action($id) {

 
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository("GestionAdminBundle:prixpayement")->findOneById($id); // id 1 already exists in the database, I just want to update this row
 
 
 
        if ($entities->getFlagpayement() == 0) {
            $entities->setFlagpayement(1);
            $em->merge($entities);
        } else {
            $entities->setFlagpayement(0);
            $em->merge($entities);
        }
        $em->flush();

 
 return $this->redirect($this->generateUrl('listepayementbureauValider'
             
        ));
    }
     public function Activepayment2Action($id) {

 
 return $this->redirect($this->generateUrl('offr_detailpayementValider', array(
                    'id' => $id,
             
        )));
    }
      public function detailpayementValiderAction($id) {


        $Request = $this->getRequest();
      

        $sql = "select p.*,o.*,u.*,r.* from admin_promovacancs.commande_payement cp,admin_promovacancs.package p,admin_promovacancs.offre o,admin_promovacancs.prixpayement pp,admin_promovacancs.user u ,admin_promovacancs.reservation r  where "
                . "r.id=cp.reservation_id  and u.id=pp.user_id and cp.prixpayement_id=pp.id   and o.id=p.offre_id and cp.idpack=p.idpack  and    pp.mode_payement='Payer au bureau' and pp.id=" . $id . " and  cp.prixpayement_id=" . $id . " Limit 1";
  //     echo $sql;
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();

        $sql1 = "select pp.* from admin_promovacancs.prixpayement pp   where "
                . "pp.mode_payement='Payer au bureau' and pp.id=" . $id . " ";
         //echo $sql1;
        $em1 = $this->getDoctrine()->getEntityManager();
        $stmt1 = $em1->getConnection()->prepare($sql1);
        $stmt1->execute();
        $entities1 = $stmt1->fetchAll();

        
          $sqla = "select p.*,o.*,u.*,r.* from admin_promovacancs.commande_payement cp,admin_promovacancs.package p,admin_promovacancs.offre o,admin_promovacancs.prixpayement pp,admin_promovacancs.user u ,admin_promovacancs.reservation r  where "
                . "r.id=cp.reservation_id  and u.id=pp.user_id and cp.prixpayement_id=pp.id   and o.id=p.offre_id and cp.idpack=p.idpack  and    pp.mode_payement='Payer au bureau' and pp.id=" . $id . " and  cp.prixpayement_id=" . $id . "";
   //echo $sqla;
        $ema = $this->getDoctrine()->getEntityManager();
        $stmta = $ema->getConnection()->prepare($sqla);
        $stmta->execute();
        $entitiesa = $stmta->fetchAll();
        
  return $this->render('GestionAdminBundle:Offre:detailpayementValider.html.twig', array(
                    'entities' => $entities,
        'entitiesa' => $entitiesa,
                    'entities1' => $entities1,
        ));
    }
      
      public function listepayementparcarteValiderAction() {

     
        $sql = "select  pp.* ,u.nom,u.prenom,u.username,u.teleph from admin_promovacancs.prixpayement pp,admin_promovacancs.user u where pp.user_id=u.id and pp.mode_payement='Payer par carte' and pp.flag_valid=1  and pp.flag_payement=1 ";
  
        $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();


        return $this->render('GestionAdminBundle:Offre:listepayementparcarteValider.html.twig', array(
                    'entities' => $entities,
        ));
    }
    
    
    
    
    
    
    
     public function paymentparcarteAction(Request $request) {


        $Request = $this->getRequest();
        $userid = $this->get('security.context')->getToken()->getUser()->getId();
        $session = $this->getRequest()->getSession();
        $id = "";


        if (!empty($_POST["ran"])) {
            $ran = $_POST["ran"];
        }
        $date1 = "";


        if (!empty($_POST["date1"])) {
            $date1 = $_POST["date1"];
        }

        $sql3 = "  update admin_promovacancs.reservation   set   etat_valid=1 "
                . " where  user_id=" . $userid . "";

        $em2 = $this->getDoctrine()->getEntityManager();
        $stmt2 = $em2->getConnection()->prepare($sql3);
        $stmt2->execute();


        if ($Request->getMethod() == 'POST') {

            $sql23 = "select  MAX(id) as id from admin_promovacancs.prixpayement LIMIT 1";
           // echo $sql23;
            $em23 = $this->getDoctrine()->getEntityManager();
            $stmt23 = $em23->getConnection()->prepare($sql23);
            $stmt23->execute();
            $entities23 = $stmt23->fetchAll();


            foreach ($entities23 as $row1) {
                $id1 = $row1['id'] + 1;



                if (!empty($_POST[$id1])) {
                    $id1 = $_POST[$id1];
                }
            }
        }


        if ($Request->getMethod() == 'POST') {

            $ptixtotal = $Request->get("ptixtotal");
            $nbre = $Request->get("nbre");

            $ran = $Request->get("ran");

            $sql2 = "insert into admin_promovacancs.prixpayement "
                    . " values(" . $id1 . "," . $userid . "," . $ptixtotal . ",'1'," . $nbre . ",'0'," . $ran . ",'Payer par carte','" . $date1 . "') ";

            $em2 = $this->getDoctrine()->getEntityManager();
            $stmt2 = $em2->getConnection()->prepare($sql2);
            $stmt2->execute();
        }

        if (!empty($_POST["panierid"])) {
            $panierid = $_POST["panierid"];
         // echo print_r($panierid);
          // echo var_dump($panierid);
        }



        foreach ($panierid as $key => $value) {

//prixpayement=id - key=reservation_id ran=ran - value=idpk
            $sql3 = "insert into admin_promovacancs.commande_payement "
                    . " values(".$id1."," . $key . "," . $ran . "," . $value . ") ";
            $em3 = $this->getDoctrine()->getEntityManager();
            $stmt3 = $em3->getConnection()->prepare($sql3);
            $stmt3->execute();
            //echo $sql3;
        }




        return $this->redirect($this->generateUrl('payementvalider', array('ran' => $ran)));

        return $this->render('GestionAdminBundle:Offre:paymentparcarte.html.twig', array(
                    'ran' => $ran,
        ));
    }

    
    
    
    
    
    
    
    
    
    
    
    
     public function facturecouponAction($couponarticle,$coupon) {


        $Request = $this->getRequest();
      

        $sql = "select p.*,o.*,u.*,r.* from admin_promovacancs.commande_payement cp,admin_promovacancs.package p,admin_promovacancs.offre o,admin_promovacancs.prixpayement pp,admin_promovacancs.user u ,admin_promovacancs.reservation r  where "
                . "r.id=cp.reservation_id  and u.id=pp.user_id and cp.prixpayement_id=pp.id   and o.id=p.offre_id and cp.idpack=p.idpack  and   pp.mode_payement='Payer au bureau' and pp.coupon=" . $coupon . " and r.couponarticle='".$couponarticle."'  Limit 1";
      //echo $sql;
         $em = $this->getDoctrine()->getEntityManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $entities = $stmt->fetchAll();

        $sql1 = "select pp.* from admin_promovacancs.prixpayement pp   where "
                . "pp.mode_payement='Payer au bureau' and pp.coupon=" . $coupon . " ";
       
        $em1 = $this->getDoctrine()->getEntityManager();
        $stmt1 = $em1->getConnection()->prepare($sql1);
        $stmt1->execute();
        $entities1 = $stmt1->fetchAll();

        
          $sqla = "select p.*,o.*,r.* from admin_promovacancs.commande_payement cp,admin_promovacancs.package p,admin_promovacancs.offre o,admin_promovacancs.prixpayement pp ,admin_promovacancs.reservation r  where "
                . "r.id=cp.reservation_id and cp.prixpayement_id=pp.id   and o.id=p.offre_id and cp.idpack=p.idpack  and   pp.mode_payement='Payer au bureau' and pp.coupon=" . $coupon . " and r.couponarticle='".$couponarticle."'  Limit 1";
        $ema = $this->getDoctrine()->getEntityManager();
        $stmta = $ema->getConnection()->prepare($sqla);
        $stmta->execute();
        $entitiesa = $stmta->fetchAll();
        $html = $this -> render('GestionAdminBundle:Offre:facture.html.twig');
  return $this->render('GestionAdminBundle:Offre:facturecoupon.html.twig', array(
                    'entities' => $entities,
        'entitiesa' => $entitiesa,
                    'entities1' => $entities1,
        ));
    }
    
    
    
    
}
