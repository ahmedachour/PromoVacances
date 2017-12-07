<?php

namespace Gestion\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\AdminBundle\Entity\OffreRepository")
 */
class Offre
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
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

        /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;
    
        /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_offre", type="date")
     */
    private $dateOffre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat_offre", type="integer")
     */
    private $etatOffre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=900)
     */
    private $description;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="tripadivisor", type="string", length=9000,nullable=true)
     */
    private $tripadivisor;

    /**
     * @var string
     *
     * @ORM\Column(name="type_offre", type="string", length=255)
     */
    private $typeOffre;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="maps", type="string", length=9000)
     */
    private $maps;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre_pers", type="integer")
     */
    private $nbrePers;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="reduction", type="string", length=255)
     */
    private $reduction;

    /**
     * @var string
     *
     * @ORM\Column(name="description2", type="string", length=1000)
     */
    private $description2;


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
     * Set titre
     *
     * @param string $titre
     * @return Offre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Offre
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set dateOffre
     *
     * @param \DateTime $dateOffre
     * @return Offre
     */
    public function setDateOffre($dateOffre)
    {
        $this->dateOffre = $dateOffre;

        return $this;
    }

    /**
     * Get dateOffre
     *
     * @return \DateTime 
     */
    public function getDateOffre()
    {
        return $this->dateOffre;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Offre
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Offre
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set etatOffre
     *
     * @param integer $etatOffre
     * @return Offre
     */
    public function setEtatOffre($etatOffre)
    {
        $this->etatOffre = $etatOffre;

        return $this;
    }

    /**
     * Get etatOffre
     *
     * @return integer 
     */
    public function getEtatOffre()
    {
        return $this->etatOffre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Offre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set typeOffre
     *
     * @param string $typeOffre
     * @return Offre
     */
    public function setTypeOffre($typeOffre)
    {
        $this->typeOffre = $typeOffre;

        return $this;
    }

    /**
     * Get typeOffre
     *
     * @return string 
     */
    public function getTypeOffre()
    {
        return $this->typeOffre;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Offre
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Offre
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
     * Set maps
     *
     * @param string $maps
     * @return Offre
     */
    public function setMaps($maps)
    {
        $this->maps = $maps;

        return $this;
    }

     /**
     * Set tripadivisor
     *
     * @param string $tripadivisor
     * @return Offre
     */
    public function setTripadivisor($tripadivisor)
    {
        $this->tripadivisor = $tripadivisor;

        return $this;
    }

    
      /**
     * Get tripadivisor
     *
     * @return string 
     */
    public function getTripadivisor()
    {
        return $this->tripadivisor;
    }
    /**
     * Get maps
     *
     * @return string 
     */
    public function getMaps()
    {
        return $this->maps;
    }

    /**
     * Set nbrePers
     *
     * @param integer $nbrePers
     * @return Offre
     */
    public function setNbrePers($nbrePers)
    {
        $this->nbrePers = $nbrePers;

        return $this;
    }

    /**
     * Get nbrePers
     *
     * @return integer 
     */
    public function getNbrePers()
    {
        return $this->nbrePers;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Offre
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set reduction
     *
     * @param string $reduction
     * @return Offre
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;

        return $this;
    }

    /**
     * Get reduction
     *
     * @return string 
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * Set description2
     *
     * @param string $description2
     * @return Offre
     */
    public function setDescription2($description2)
    {
        $this->description2 = $description2;

        return $this;
    }

    /**
     * Get description2
     *
     * @return string 
     */
    public function getDescription2()
    {
        return $this->description2;
    }
    
    
    
       public function getFullImagePath() {
        return null === $this->image ? null : $this->getUploadRootDir(). $this->image;
    }
 
    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir()."/";
    }
 
    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/image/';
    }
 
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }
        if(!$this->id){
            $this->image->move($this->getTmpUploadRootDir(), $this->image->getClientOriginalName());
        }else{
            $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        }
        $this->setImage($this->image->getClientOriginalName());
    }
 
    /**
     * @ORM\PostPersist()
     */
    public function moveImage()
    {
        if (null === $this->image) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir().$this->image);
    }
 
    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
        unlink($this->getFullImagePath());
        rmdir($this->getUploadRootDir());
    }
    
    
    
     /**
     * @ORM\OneToMany(targetEntity="Offre", mappedBy="Package", cascade={"remove"})
       * @ORM\joinColumn(onDelete="SET NULL")
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
     * @ORM\OneToMany(targetEntity="Imageoffre", mappedBy="Offre", cascade={"remove"})
       * @ORM\joinColumn(onDelete="SET NULL")
     */
         protected $imageoffre;
    
    public function getImageoffre()
    {
        return $this->imageoffre;
    }
    
       public function setImageoffre($imageoffre)
    {
        $this->imageoffre = $imageoffre;
    
        return $this;
    }
    
    
    
       /**
     * @ORM\OneToMany(targetEntity="reservation", mappedBy="Offre", cascade={"remove"})
      *@ORM\JoinColumn(onDelete="CASCADE")
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
    return $this->getTypeOffre();
} 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->package = new \Doctrine\Common\Collections\ArrayCollection();
        $this->imageoffre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add package
     *
     * @param \Gestion\AdminBundle\Entity\Offre $package
     * @return Offre
     */
    public function addPackage(\Gestion\AdminBundle\Entity\Offre $package)
    {
        $this->package[] = $package;

        return $this;
    }

    /**
     * Remove package
     *
     * @param \Gestion\AdminBundle\Entity\Offre $package
     */
    public function removePackage(\Gestion\AdminBundle\Entity\Offre $package)
    {
        $this->package->removeElement($package);
    }

    /**
     * Add imageoffre
     *
     * @param \Gestion\AdminBundle\Entity\Imageoffre $imageoffre
     * @return Offre
     */
    public function addImageoffre(\Gestion\AdminBundle\Entity\Imageoffre $imageoffre)
    {
        $this->imageoffre[] = $imageoffre;

        return $this;
    }

    /**
     * Remove imageoffre
     *
     * @param \Gestion\AdminBundle\Entity\Imageoffre $imageoffre
     */
    public function removeImageoffre(\Gestion\AdminBundle\Entity\Imageoffre $imageoffre)
    {
        $this->imageoffre->removeElement($imageoffre);
    }

    /**
     * Add reservation
     *
     * @param \Gestion\AdminBundle\Entity\reservation $reservation
     * @return Offre
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

    /**
     * Set telephone
     *
     * @param integer $telephone
     * @return Offre
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Offre
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
     * Set adresse
     *
     * @param string $adresse
     * @return Offre
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
}
