<?php

namespace CYTN\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Teams
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=3)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="CYTN\CoreBundle\Entity\Flag", cascade={"persist", "remove"})
     */
    private $flag;

    /**
     * @ORM\OneToOne(targetEntity="CYTN\CoreBundle\Entity\MatchTeamIn", cascade={"persist"})
     */
    private $matchTeamIn;

    /**
     * @ORM\OneToOne(targetEntity="CYTN\CoreBundle\Entity\MatchTeamOut", cascade={"persist"})
     */
    private $matchTeamOut;

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
     * Set name
     *
     * @param string $name
     * @return Teams
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
     * Set shortName
     *
     * @param string $shortName
     * @return Teams
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set flag
     *
     * @param string $flag
     * @return Teams
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->flag;
    }
    

    /**
     * Set matchTeamIn
     *
     * @param \CYTN\CoreBundle\Entity\MatchTeamIn $matchTeamIn
     * @return Teams
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
     * @return Teams
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
}
