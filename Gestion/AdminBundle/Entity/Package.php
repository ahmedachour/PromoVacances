<?php

namespace Gestion\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Package
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\AdminBundle\Entity\PackageRepository")
 */
class Package
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpack", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpack;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var float
     *
     * @ORM\Column(name="ancien_prix", type="float")
     */
    private $ancienPrix;

    
     /**
     * @var string
     *
     * @ORM\Column(name="pack", type="string", length=255)
     */
    private $pack;
    
    /**
     * Set pack
     *
     * @param string $pack
     * @return Offre
     */
    public function setPack($pack)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return string 
     */
    public function getPack()
    {
        return $this->pack;
    }
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="etatp", type="string",nullable=true)
     */
    private $etatp;
    
    /**
     * Set etatp
     *
     * @param string $etatp
     * @return Offre
     */
    public function setEtatp($etatp)
    {
        $this->etatp = $etatp;

        return $this;
    }

    /**
     * Get etatp
     *
     * @return string 
     */
    public function getEtatp()
    {
        return $this->etatp;
    }
    

    /**
     * Get idpack
     *
     * @return integer 
     */
    public function getIdpack()
    {
        return $this->idpack;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Package
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
     * Set ancienPrix
     *
     * @param float $ancienPrix
     * @return Package
     */
    public function setAncienPrix($ancienPrix)
    {
        $this->ancienPrix = $ancienPrix;

        return $this;
    }

    /**
     * Get ancienPrix
     *
     * @return float 
     */
    public function getAncienPrix()
    {
        return $this->ancienPrix;
    }
    
    
     /**
     * @ORM\ManyToOne(targetEntity="Gestion\AdminBundle\Entity\Offre", inversedBy="Package", cascade={"remove"})
    * @ORM\joinColumn(onDelete="SET NULL")
      *  */
   

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
     * @ORM\OneToMany(targetEntity="reservation", mappedBy="Package")
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
     * Add reservation
     *
     * @param \Gestion\AdminBundle\Entity\reservation $reservation
     * @return Package
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
