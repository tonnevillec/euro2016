<?php
namespace CYTN\CoreBundle\Services;

use Doctrine\ORM\EntityManager;

class BddRequests{

    private $_em;

    public function __construct(EntityManager $entityManager)
    {
        $this->_em = $entityManager;
    }

    public function findScoreInDeal($match, $user)
    {
        $deal = $this->_em->getRepository('CYTNCoreBundle:Deals')->findOneBy(array('match'=>$match, 'user'=>$user));
        return $deal === NULL ? 0 : $deal->getInScore();
    }

    public function findScoreOutDeal($match, $user)
    {
        $deal = $this->_em->getRepository('CYTNCoreBundle:Deals')->findOneBy(array('match'=>$match, 'user'=>$user));
        return $deal === NULL ? 0 : $deal->getOutScore();
    }

    public function findDealPoints($match, $user)
    {
        $deal = $this->_em->getRepository('CYTNCoreBundle:Deals')->findOneBy(array('match'=>$match, 'user'=>$user));
        return $deal === NULL ? 0 : $deal->getPoints();
    }

    public function updatePoints($matchId, $inScore, $outScore)
    {
        $dealZero = $this->_em
            ->getRepository('CYTNCoreBundle:Deals')
            ->findBy(array('match'=>$matchId));
        foreach ($dealZero as $dealZ) {
            $dealZ->setPoints(0);
            $this->_em->persist($dealZ);
        }
        $this->_em->flush();

        $deals = $this->_em
            ->getRepository('CYTNCoreBundle:Deals')
            ->findBy(array('match' => $matchId));
        $nb = count($deals);
        $compt = 0;
        $bonus = 0;
        foreach ($deals as $deal) {
            if ($inScore > $outScore && $deal->getInScore() > $deal->getOutScore()) {
                $this->_em->getRepository('CYTNCoreBundle:Deals')->find($deal->getId())->setPoints(1);
                $compt++;
            }
            if ($inScore < $outScore && $deal->getInScore() < $deal->getOutScore()) {
                $this->_em->getRepository('CYTNCoreBundle:Deals')->find($deal->getId())->setPoints(1);
                $compt++;
            }
            if ($inScore == $outScore && $deal->getInScore() == $deal->getOutScore()) {
                $this->_em->getRepository('CYTNCoreBundle:Deals')->find($deal->getId())->setPoints(1);
                $compt++;
            }
            if ($inScore == $deal->getInScore() && $outScore == $deal->getOutScore()) {
                $this->_em->getRepository('CYTNCoreBundle:Deals')->find($deal->getId())->setPoints(2);
                $bonus++;
            }

            $this->_em->persist($deal);
        }
        $this->_em->flush();

        if ($compt != 0) {
            $pts1 = ($nb / $compt) * 10;
        }
        else{
            $pts1 = 0;
        }

        if($bonus != 0){
            $pts2 = $pts1 + (($nb / $bonus) * 10);
        }
        else{
            $pts2 = 0;
        }

        $dealBonus = $this->_em
            ->getRepository('CYTNCoreBundle:Deals')
            ->findBy(array('match'=>$matchId, 'points'=>2));
        foreach ($dealBonus as $dealB){
            $dealB->setPoints($pts2);
            $this->_em->persist($dealB);
        }

        $dealOk = $this->_em
            ->getRepository('CYTNCoreBundle:Deals')
            ->findBy(array('match'=>$matchId, 'points'=>1));
        foreach ($dealOk as $dealO) {
            $dealO->setPoints($pts1);
            $this->_em->persist($dealO);
        }

        $this->_em->flush();
    }
}