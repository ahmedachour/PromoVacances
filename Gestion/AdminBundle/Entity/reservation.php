<?php

namespace Gestion\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * reservation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\AdminBundle\Entity\reservationRepository")
 */
class reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_pers_reserve", type="integer")
     */
    private $nbrePersReserve;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_total", type="float")
     */
    private $prixTotal;

      /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="etat_payment", type="integer")
     */
    private $etatPayment;

  /**
     * @var integer
     *
     * @ORM\Column(name="etat_valid", type="integer")
     */
    private $etatValid;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nbrePersReserve
     *
     * @param integer $nbrePersReserve
     * @return reservation
     */
    public function setNbrePersReserve($nbrePersReserve)
    {
        $this->nbrePersReserve = $nbrePersReserve;

        return $this;
    }

    /**
     * Get nbrePersReserve
     *
     * @return integer 
     */
    public function getNbrePersReserve()
    {
        return $this->nbrePersReserve;
    }

    /**
     * Set prixTotal
     *
     * @param float $prixTotal
     * @return reservation
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return float 
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    
    
      /**
     * Set prix
     *
     * @param float $prix
     * @return reservation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    
    
    /**
     * Set etatPayment
     *
     * @param integer $etatPayment
     * @return reservation
     */
    public function setEtatPayment($etatPayment)
    {
        $this->etatPayment = $etatPayment;

        return $this;
    }

    /**
     * Get etatPayment
     *
     * @return integer 
     */
    public function getEtatPayment()
    {
        return $this->etatPayment;
    }
    
     
    
    
    /**
     * Set etatValid
     *
     * @param integer $etatValid
     * @return reservation
     */
    public function setEtatValid($etatValid)
    {
        $this->etatValid = $etatValid;

        return $this;
    }

    /**
     * Get etatValid
     *
     * @return integer 
     */
    public function getEtatValid()
    {
        return $this->etatValid;
    }
    
      
    /**
     * @ORM\ManyToOne(targetEntity="Gestion\AdminBundle\Entity\Offre")
     */
   
         protected $offre;
    
    public function getOffre()
    {
        return $this->offre;
    }
    
       public function setOffre($offre)
    {
        $this->offre = $offre;
    
        return $this;
    }
    
      /**
     * @ORM\ManyToOne(targetEntity="Gestion\AdminBundle\Entity\User")
     */
   
         protected $user;
    
    public function getUser()
    {
        return $this->user;
    }
    
       public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Gestion\AdminBundle\Entity\Package")
     * @ORM\JoinColumn(name="package_idpack", referencedColumnName="idpack")
     */
     
        protected $package;
    
    public function getPackage()
    {
        return $this->package;
    }
    
       public function setPackage($package)
    {
        $this->package = $package;
    
        return $this;
    }
    
    
    
     /**
     * @ORM\ManyToMany(targetEntity="Prixpayement",inversedBy="reservation" , cascade={"remove"})
      *@ORM\JoinColumn(onDelete="CASCADE")
     */ 
       
   
   
      private $prixpayement;
    
     /**
     * Get prixpayement
     *
     * @return \Gestion\AdminBundle\Entity\Prixpayement
     */
    public function getPrixpayement()
    {
        return $this->prixpayement;
    }
      
   /**
     * Set prixpayement
     *
     * @return \Gestion\AdminBundle\Entity\Prixpayement 
     *  
     */
    public function setPrixpayement($prixpayement)
    {
        $this->prixpayement = $prixpayement;
    
        return $this;
    }
    
        /**
     * @var string
     *
     * @ORM\Column(name="couponarticle", type="string")
     */
    private $couponarticle;
     /**
     * Set couponarticle
     *
     * @param string $couponarticle
     * @return reservation
     */
    public function setCouponarticle($couponarticle)
    {
        $this->couponarticle = $couponarticle;

        return $this;
    }

    /**
     * Get couponarticle
     *
     * @return string 
     */
    public function getCouponarticle()
    {
        return $this->couponarticle;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prixpayement = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add prixpayement
     *
     * @param \Gestion\AdminBundle\Entity\Prixpayement $prixpayement
     * @return reservation
     */
    public function addPrixpayement(\Gestion\AdminBundle\Entity\Prixpayement $prixpayement)
    {
        $this->prixpayement[] = $prixpayement;

        return $this;
    }

    /**
     * Remove prixpayement
     *
     * @param \Gestion\AdminBundle\Entity\Prixpayement $prixpayement
     */
    public function removePrixpayement(\Gestion\AdminBundle\Entity\Prixpayement $prixpayement)
    {
        $this->prixpayement->removeElement($prixpayement);
    }
}
