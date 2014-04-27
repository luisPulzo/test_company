<?php

namespace Camilo\Bundle\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Places
 *
 * @ORM\Table(name="places", indexes={@ORM\Index(name="order_id", columns={"order_id"})})
 * @ORM\Entity
 */
class Places
{
    /**
     * @var integer
     *
     * @ORM\Column(name="num_place", type="integer", nullable=true)
     */
    private $numPlace;

    /**
     * @var integer
     *
     * @ORM\Column(name="place_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $placeId;

    /**
     * @var \Camilo\Bundle\ApiBundle\Entity\Orders
     *
     * @ORM\ManyToOne(targetEntity="Camilo\Bundle\ApiBundle\Entity\Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="order_id")
     * })
     */
    private $order;



    /**
     * Set numPlace
     *
     * @param integer $numPlace
     * @return Places
     */
    public function setNumPlace($numPlace)
    {
        $this->numPlace = $numPlace;

        return $this;
    }

    /**
     * Get numPlace
     *
     * @return integer 
     */
    public function getNumPlace()
    {
        return $this->numPlace;
    }

    /**
     * Get placeId
     *
     * @return integer 
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * Set order
     *
     * @param \Camilo\Bundle\ApiBundle\Entity\Orders $order
     * @return Places
     */
    public function setOrder(\Camilo\Bundle\ApiBundle\Entity\Orders $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Camilo\Bundle\ApiBundle\Entity\Orders 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
