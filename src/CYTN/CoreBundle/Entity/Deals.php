<?php

namespace CYTN\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CYTN\UserBundle;

/**
 * Deals
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Deals
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
     * @ORM\Column(name="inScore", type="integer")
     */
    private $inScore;

    /**
     * @var integer
     *
     * @ORM\Column(name="outScore", type="integer")
     */
    private $outScore;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points = 0;

    /**
     * @ORM\ManyToOne(targetEntity="CYTN\CoreBundle\Entity\Matchs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $match;

    /**
     * @ORM\ManyToOne(targetEntity="CYTN\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
     * Set inScore
     *
     * @param integer $inScore
     * @return Deals
     */
    public function setInScore($inScore)
    {
        $this->inScore = $inScore;

        return $this;
    }

    /**
     * Get inScore
     *
     * @return integer 
     */
    public function getInScore()
    {
        return $this->inScore;
    }

    /**
     * Set outScore
     *
     * @param integer $outScore
     * @return Deals
     */
    public function setOutScore($outScore)
    {
        $this->outScore = $outScore;

        return $this;
    }

    /**
     * Get outScore
     *
     * @return integer 
     */
    public function getOutScore()
    {
        return $this->outScore;
    }

    /**
     * Set match
     *
     * @param \CYTN\CoreBundle\Entity\Matchs $match
     * @return Deals
     */
    public function setMatch(\CYTN\CoreBundle\Entity\Matchs $match)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \CYTN\CoreBundle\Entity\Matchs 
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set user
     *
     * @param \CYTN\UserBundle\Entity\User $user
     * @return Deals
     */
    public function setUser(\CYTN\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CYTN\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return Deals
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }
}
