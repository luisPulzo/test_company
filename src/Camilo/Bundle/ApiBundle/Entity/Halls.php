<?php

namespace Camilo\Bundle\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Halls
 *
 * @ORM\Table(name="halls", indexes={@ORM\Index(name="auditorium_ibfk_1", columns={"cinema_id"})})
 * @ORM\Entity
 */
class Halls
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="hall_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $hallId;

    /**
     * @var \Camilo\Bundle\ApiBundle\Entity\Cinemas
     *
     * @ORM\ManyToOne(targetEntity="Camilo\Bundle\ApiBundle\Entity\Cinemas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cinema_id", referencedColumnName="cinema_id")
     * })
     */
    private $cinema;



    /**
     * Set name
     *
     * @param string $name
     * @return Halls
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get hallId
     *
     * @return integer 
     */
    public function getHallId()
    {
        return $this->hallId;
    }

    /**
     * Set cinema
     *
     * @param \Camilo\Bundle\ApiBundle\Entity\Cinemas $cinema
     * @return Halls
     */
    public function setCinema(\Camilo\Bundle\ApiBundle\Entity\Cinemas $cinema = null)
    {
        $this->cinema = $cinema;

        return $this;
    }

    /**
     * Get cinema
     *
     * @return \Camilo\Bundle\ApiBundle\Entity\Cinemas 
     */
    public function getCinema()
    {
        return $this->cinema;
    }
}
