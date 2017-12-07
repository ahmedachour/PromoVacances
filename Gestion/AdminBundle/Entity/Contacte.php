<?php

namespace Gestion\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacte
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\AdminBundle\Entity\ContacteRepository")
 */
class Contacte
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
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=500)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="teleph", type="integer")
     */
    private $teleph;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var integer
     *
     * @ORM\Column(name="codeP", type="integer")
     */
    private $codeP;

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="string", length=2000)
     */
    private $msg;

    /**
     * @var integer
     *
     * @ORM\Column(name="repondre", type="integer")
     */
    private $repondre;

    /**
     * @var integer
     *
     * @ORM\Column(name="lire", type="integer")
     */
    private $lire;


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
     * Set nom
     *
     * @param string $nom
     * @return Contacte
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
     * @return Contacte
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
     * Set adresse
     *
     * @param string $adresse
     * @return Contacte
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Contacte
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set teleph
     *
     * @param integer $teleph
     * @return Contacte
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
     * Set email
     *
     * @param string $email
     * @return Contacte
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

    /**
     * Set pays
     *
     * @param string $pays
     * @return Contacte
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set codeP
     *
     * @param integer $codeP
     * @return Contacte
     */
    public function setCodeP($codeP)
    {
        $this->codeP = $codeP;

        return $this;
    }

    /**
     * Get codeP
     *
     * @return integer 
     */
    public function getCodeP()
    {
        return $this->codeP;
    }

    /**
     * Set msg
     *
     * @param string $msg
     * @return Contacte
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string 
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set repondre
     *
     * @param integer $repondre
     * @return Contacte
     */
    public function setRepondre($repondre)
    {
        $this->repondre = $repondre;

        return $this;
    }

    /**
     * Get repondre
     *
     * @return integer 
     */
    public function getRepondre()
    {
        return $this->repondre;
    }

    /**
     * Set lire
     *
     * @param integer $lire
     * @return Contacte
     */
    public function setLire($lire)
    {
        $this->lire = $lire;

        return $this;
    }

    /**
     * Get lire
     *
     * @return integer 
     */
    public function getLire()
    {
        return $this->lire;
    }
}
