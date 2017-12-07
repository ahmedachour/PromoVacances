<?php

namespace Gestion\AdminBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        
    }

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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

  

    
    /**
     * @var integer
     *
     * @ORM\Column(name="teleph", type="integer")
     */
    private $teleph;

 
 
    

    /**
     * Set nom
     *
     * @param string $nom
     * @return Internaute
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Internaute
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Internaute
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    
     public function getPassword()
    {
        return $this->password;
    }
    
       public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
 

        public function getEnabled()
    {
        return $this->enabled;
    }
     public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }
    
    /**
     * Set teleph
     *
     * @param integer $teleph
     * @return Internaute
     */
    public function setTeleph($teleph)
    {
        $this->teleph = $teleph;

        return $this;
    }

    /**
     * Get teleph
     *
     * @return integer 
     */
    public function getTeleph()
    {
        return $this->teleph;
    }

 
  
 
    
    
    
          /**
     * @ORM\OneToMany(targetEntity="Prixpayement", mappedBy="User")
     */
         protected $prixpayement;
    
    public function getPrixpayement()
    {
        return $this->prixpayement;
    }
    
       public function setPrixpayement($prixpayement)
    {
        $this->prixpayement = $prixpayement;
    
        return $this;
    }
    
    
          /**
     * @ORM\OneToMany(targetEntity="reservation", mappedBy="User")
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
     
           public function __toString()
{
    return $this->getEmail();
}
    

    /**
     * Add prixpayement
     *
     * @param \Gestion\AdminBundle\Entity\Prixpayement $prixpayement
     * @return User
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

    /**
     * Add reservation
     *
     * @param \Gestion\AdminBundle\Entity\reservation $reservation
     * @return User
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
