<?php

namespace CYTN\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CYTN\CoreBundle\Entity\GroupTeamRepository")
 */
class GroupTeam
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="point", type="integer")
     */
    private $point;

    /**
     * @ORM\Column(name="win", type="integer")
     */
    private $win;

    /**
     * @ORM\Column(name="lose", type="integer")
     */
    private $lose;

    /**
     * @ORM\Column(name="draw", type="integer")
     */
    private $draw;

    /**
     * @ORM\Column(name="goalfor", type="integer")
     */
    private $goalfor;

    /**
     * @ORM\Column(name="goalagainst", type="integer")
     */
    private $goalagainst;

    /**
     * @ORM\ManyToOne(targetEntity="CYTN\CoreBundle\Entity\Groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity="CYTN\CoreBundle\Entity\Teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;



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
     * Set point
     *
     * @param integer $point
     * @return GroupTeam
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return integer 
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set win
     *
     * @param integer $win
     * @return GroupTeam
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return integer 
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set lose
     *
     * @param integer $lose
     * @return GroupTeam
     */
    public function setLose($lose)
    {
        $this->lose = $lose;

        return $this;
    }

    /**
     * Get lose
     *
     * @return integer 
     */
    public function getLose()
    {
        return $this->lose;
    }

    /**
     * Set draw
     *
     * @param integer $draw
     * @return GroupTeam
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * Get draw
     *
     * @return integer 
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Set goalfor
     *
     * @param integer $goalfor
     * @return GroupTeam
     */
    public function setGoalfor($goalfor)
    {
        $this->goalfor = $goalfor;

        return $this;
    }

    /**
     * Get goalfor
     *
     * @return integer 
     */
    public function getGoalfor()
    {
        return $this->goalfor;
    }

    /**
     * Set goalagainst
     *
     * @param integer $goalagainst
     * @return GroupTeam
     */
    public function setGoalagainst($goalagainst)
    {
        $this->goalagainst = $goalagainst;

        return $this;
    }

    /**
     * Get goalagainst
     *
     * @return integer 
     */
    public function getGoalagainst()
    {
        return $this->goalagainst;
    }

    /**
     * Set group
     *
     * @param \CYTN\CoreBundle\Entity\Groups $group
     * @return GroupTeam
     */
    public function setGroup(\CYTN\CoreBundle\Entity\Groups $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \CYTN\CoreBundle\Entity\Groups 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set team
     *
     * @param \CYTN\CoreBundle\Entity\Teams $team
     * @return GroupTeam
     */
    public function setTeam(\CYTN\CoreBundle\Entity\Teams $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \CYTN\CoreBundle\Entity\Teams 
     */
    public function getTeam()
    {
        return $this->team;
    }
}
