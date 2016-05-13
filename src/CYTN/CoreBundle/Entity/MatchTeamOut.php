<?php
namespace CYTN\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CYTN\CoreBundle\Entity\MatchTeamOutRepository")
 */
class MatchTeamOut
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity="CYTN\CoreBundle\Entity\Teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teams;

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
     * Set score
     *
     * @param integer $score
     * @return MatchTeamOut
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set teams
     *
     * @param \CYTN\CoreBundle\Entity\Teams $teams
     * @return MatchTeamOut
     */
    public function setTeams(\CYTN\CoreBundle\Entity\Teams $teams)
    {
        $this->teams = $teams;

        return $this;
    }

    /**
     * Get teams
     *
     * @return \CYTN\CoreBundle\Entity\Teams
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
