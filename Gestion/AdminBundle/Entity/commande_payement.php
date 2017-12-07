<?php

namespace Gestion\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commande_payement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\AdminBundle\Entity\commande_payementRepository")
 */
class commande_payement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idpack;
  

    /**
     * @var integer
     *
     * @ORM\Column(name="prixpayement_id", type="integer")
     */
    private $prixpayementId;

    /**
     * @var integer
     *
     * @ORM\Column(name="reservation_id", type="integer")
     */
    private $reservationId;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon", type="string", length=255)
     */
    private $coupon;


  

    /**
     * Set prixpayementId
     *
     * @param integer $prixpayementId
     * @return commande_payement
     */
    public function setPrixpayementId($prixpayementId)
    {
        $this->prixpayementId = $prixpayementId;

        return $this;
    }

    /**
     * Get prixpayementId
     *
     * @return integer 
     */
    public function getPrixpayementId()
    {
        return $this->prixpayementId;
    }

    /**
     * Set reservationId
     *
     * @param integer $reservationId
     * @return commande_payement
     */
    public function setReservationId($reservationId)
    {
        $this->reservationId = $reservationId;

        return $this;
    }

    /**
     * Get reservationId
     *
     * @return integer 
     */
    public function getReservationId()
    {
        return $this->reservationId;
    }

    /**
     * Set coupon
     *
     * @param string $coupon
     * @return commande_payement
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->idpack;
    }
}
