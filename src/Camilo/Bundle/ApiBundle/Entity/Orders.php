<?php

namespace Camilo\Bundle\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="schedule_id", columns={"schedule_id"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=16, nullable=true)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=45, nullable=true)
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderId;

    /**
     * @var \Camilo\Bundle\ApiBundle\Entity\Sessions
     *
     * @ORM\ManyToOne(targetEntity="Camilo\Bundle\ApiBundle\Entity\Sessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="schedule_id", referencedColumnName="session_id")
     * })
     */
    private $schedule;



    /**
     * Set key
     *
     * @param string $key
     * @return Orders
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Orders
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set schedule
     *
     * @param \Camilo\Bundle\ApiBundle\Entity\Sessions $schedule
     * @return Orders
     */
    public function setSchedule(\Camilo\Bundle\ApiBundle\Entity\Sessions $schedule = null)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return \Camilo\Bundle\ApiBundle\Entity\Sessions 
     */
    public function getSchedule()
    {
        return $this->schedule;
    }
}
