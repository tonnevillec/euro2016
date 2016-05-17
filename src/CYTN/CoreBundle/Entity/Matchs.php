<?php

namespace CYTN\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CYTN\CoreBundle\Entity\MatchsRepository")
*/
class Matchs
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
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isOpen", type="boolean")
     */
    private $isOpen;

    /**
     * @ORM\OneToOne(targetEntity="CYTN\CoreBundle\Entity\MatchTeamIn", cascade={"persist"})
     */
    private $matchTeamIn;

    /**
     * @ORM\OneToOne(targetEntity="CYTN\CoreBundle\Entity\MatchTeamOut", cascade={"persist"})
     */
    private $matchTeamOut;

    /**
     * @ORM\ManyToOne(targetEntity="CYTN\CoreBundle\Entity\Groups")
     * * @ORM\JoinColumn(nullable=false)
     */
    private $groups;

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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Matchs
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set isOpen
     *
     * @param boolean $isOpen
     * @return Matchs
     */
    public function setIsOpen($isOpen)
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    /**
     * Get isOpen
     *
     * @return boolean 
     */
    public function getIsOpen()
    {
        return $this->isOpen;
    }

    /**
     * Set matchTeamIn
     *
     * @param \CYTN\CoreBundle\Entity\MatchTeamIn $matchTeamIn
     * @return Matchs
     */
    public function setMatchTeamIn(\CYTN\CoreBundle\Entity\MatchTeamIn $matchTeamIn = null)
    {
        $this->matchTeamIn = $matchTeamIn;

        return $this;
    }

    /**
     * Get matchTeamIn
     *
     * @return \CYTN\CoreBundle\Entity\MatchTeamIn 
     */
    public function getMatchTeamIn()
    {
        return $this->matchTeamIn;
    }


    /**
     * Set matchTeamOut
     *
     * @param \CYTN\CoreBundle\Entity\MatchTeamOut $matchTeamOut
     * @return Matchs
     */
    public function setMatchTeamOut(\CYTN\CoreBundle\Entity\MatchTeamOut $matchTeamOut = null)
    {
        $this->matchTeamOut = $matchTeamOut;

        return $this;
    }

    /**
     * Get matchTeamOut
     *
     * @return \CYTN\CoreBundle\Entity\MatchTeamOut 
     */
    public function getMatchTeamOut()
    {
        return $this->matchTeamOut;
    }

    /**
     * Set groups
     *
     * @param \CYTN\CoreBundle\Entity\Groups $groups
     * @return Matchs
     */
    public function setGroups(\CYTN\CoreBundle\Entity\Groups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \CYTN\CoreBundle\Entity\Groups 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
