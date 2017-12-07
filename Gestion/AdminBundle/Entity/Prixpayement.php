<?php

namespace Gestion\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prixpayement
 *
 * @ORM\Table(name="prixpayement")
 * @ORM\Entity(repositoryClass="Gestion\AdminBundle\Entity\PrixpayementRepository")
 */
class Prixpayement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * @var float
     *
     * @ORM\Column(name="prix_payement_total", type="float")
     */
    private $prixPayementTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag_valid", type="integer")
     */
    private $flagvalid;

    
     /**
     * @var integer
     *
     * @ORM\Column(name="flag_payement", type="integer")
     */
    private $flagpayement;
   /**
     * @var integer
     *
     * @ORM\Column(name="qte", type="integer")
     */
    private $qte;
    
      /**
     * @var string
     *
     * @ORM\Column(name="coupon", type="string")
     */
    private $coupon;
    
     /**
     * @var string
     *
     * @ORM\Column(name="mode_payement", type="string", length=1500)
     */
    private $modePayement;
    
       /**
     * @var \string
     *
     * @ORM\Column(name="date_payement", type="string")
     */
    private $datePayement;
    
        /**
     * Set datePayement
     *
     * @param string $datePayement
     * @return prixpayement
     */
    public function setDatePayement($datePayement)
    {
        $this->datePayement = $datePayement;

        return $this;
    }

        /**
     * Set modePayement
     *
     * @param string $modePayement
     * @return modepayement
     */
    public function setModePayement($modePayement)
    {
        $this->modePayement = $modePayement;

        return $this;
    }

      /**
     * Get modePayement
     *
     * @return string 
     */
    public function getModePayement()
    {
        return $this->modePayement;
    }
    
    /**
     * Get datePayement
     *
     * @return string 
     */
    public function getDatePayement()
    {
        return $this->datePayement;
    }
    
    
   

    /**
     * Set prixPayementTotal
     *
     * @param float $prixPayementTotal
     * @return Prixpayement
     */
    public function setPrixPayementTotal($prixPayementTotal)
    {
        $this->prixPayementTotal = $prixPayementTotal;

        return $this;
    }

    /**
     * Get prixPayementTotal
     *
     * @return float 
     */
    public function getPrixPayementTotal()
    {
        return $this->prixPayementTotal;
    }

    /**
     * Set flagvalid
     *
     * @param integer $flagvalid
     * @return Prixpayement
     */
    public function setFlagvalid($flagvalid)
    {
        $this->flagvalid = $flagvalid;

        return $this;
    }
 /**
     * Set flagpayement
     *
     * @param integer $flagpayement
     * @return Prixpayement
     */
    public function setFlagpayement($flagpayement)
    {
        $this->flagpayement = $flagpayement;

        return $this;
    }
    /**
     * Get flagpayement
     *
     * @return integer 
     */
    public function getFlagpayement()
    {
        return $this->flagpayement;
    }
    
     
    
    /**
     * Set qte
     *
     * @param integer $qte
     * @return Prixpayement
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return integer 
     */
    public function getQte()
    {
        return $this->qte;
    }
    
     /**
     * Set coupon
     *
     * @param string $coupon
     * @return Prixpayement
     */
    public function setCoupon($coupon)
    {
        $this->coupon = $coupon;

        return $this;
    }

    /**
     * Get coupon
     *
     * @return string 
     */
    public function getCoupon()
    {
        return $this->coupon;
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
     * @ORM\ManyToMany(targetEntity="reservation", mappedBy="Prixpayement", cascade={"remove"})
       @ORM\JoinColumn(onDelete="CASCADE")
     */ 
     protected $reservation;
    
    public function getReservation()
    {
        return $this->reservation;
    }
    
       public function setReservation($reservation)
    {
        $this->reservation = $reservation;
    
        return $this;
    }
    
    
    
        
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get flagvalid
     *
     * @return integer 
     */
    public function getFlagvalid()
    {
        return $this->flagvalid;
    }

    /**
     * Add reservation
     *
     * @param \Gestion\AdminBundle\Entity\reservation $reservation
     * @return Prixpayement
     */
    public function addReservation(\Gestion\AdminBundle\Entity\reservation $reservation)
    {
        $this->reservation[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \Gestion\AdminBundle\Entity\reservation $reservation
     */
    public function removeReservation(\Gestion\AdminBundle\Entity\reservation $reservation)
    {
        $this->reservation->removeElement($reservation);
    }
}
