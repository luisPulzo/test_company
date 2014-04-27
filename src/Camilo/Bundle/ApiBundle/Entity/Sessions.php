<?php

namespace Camilo\Bundle\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sessions
 *
 * @ORM\Table(name="sessions", indexes={@ORM\Index(name="schedule_ibfk_2", columns={"hall_id"}), @ORM\Index(name="schedule_ibfk_1", columns={"film_id"})})
 * @ORM\Entity
 */
class Sessions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="date_movie_start", type="integer", nullable=true)
     */
    private $dateMovieStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_movie_end", type="integer", nullable=true)
     */
    private $dateMovieEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="location_info", type="text", nullable=true)
     */
    private $locationInfo;

    /**
     * @var integer
     *
     * @ORM\Column(name="session_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sessionId;

    /**
     * @var \Camilo\Bundle\ApiBundle\Entity\Halls
     *
     * @ORM\ManyToOne(targetEntity="Camilo\Bundle\ApiBundle\Entity\Halls")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hall_id", referencedColumnName="hall_id")
     * })
     */
    private $hall;

    /**
     * @var \Camilo\Bundle\ApiBundle\Entity\Films
     *
     * @ORM\ManyToOne(targetEntity="Camilo\Bundle\ApiBundle\Entity\Films")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     * })
     */
    private $film;



    /**
     * Set dateMovieStart
     *
     * @param integer $dateMovieStart
     * @return Sessions
     */
    public function setDateMovieStart($dateMovieStart)
    {
        $this->dateMovieStart = $dateMovieStart;

        return $this;
    }

    /**
     * Get dateMovieStart
     *
     * @return integer 
     */
    public function getDateMovieStart()
    {
        return $this->dateMovieStart;
    }

    /**
     * Set dateMovieEnd
     *
     * @param integer $dateMovieEnd
     * @return Sessions
     */
    public function setDateMovieEnd($dateMovieEnd)
    {
        $this->dateMovieEnd = $dateMovieEnd;

        return $this;
    }

    /**
     * Get dateMovieEnd
     *
     * @return integer 
     */
    public function getDateMovieEnd()
    {
        return $this->dateMovieEnd;
    }

    /**
     * Set locationInfo
     *
     * @param string $locationInfo
     * @return Sessions
     */
    public function setLocationInfo($locationInfo)
    {
        $this->locationInfo = $locationInfo;

        return $this;
    }

    /**
     * Get locationInfo
     *
     * @return string 
     */
    public function getLocationInfo()
    {
        return $this->locationInfo;
    }

    /**
     * Get sessionId
     *
     * @return integer 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set hall
     *
     * @param \Camilo\Bundle\ApiBundle\Entity\Halls $hall
     * @return Sessions
     */
    public function setHall(\Camilo\Bundle\ApiBundle\Entity\Halls $hall = null)
    {
        $this->hall = $hall;

        return $this;
    }

    /**
     * Get hall
     *
     * @return \Camilo\Bundle\ApiBundle\Entity\Halls 
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * Set film
     *
     * @param \Camilo\Bundle\ApiBundle\Entity\Films $film
     * @return Sessions
     */
    public function setFilm(\Camilo\Bundle\ApiBundle\Entity\Films $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \Camilo\Bundle\ApiBundle\Entity\Films 
     */
    public function getFilm()
    {
        return $this->film;
    }
}
