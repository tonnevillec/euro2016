<?php

namespace CYTN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CYTN\CoreBundle\Services;

class ResultController extends Controller
{
    public function addMatchResultAction($id, Request $request)
    {
        if($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $matchTeamIn = $em
                ->getRepository('CYTNCoreBundle:MatchTeamIn')
                ->find($id);
            $matchTeamIn->setScore($request->get('teamInScore'));

            $matchTeamOut = $em
                ->getRepository('CYTNCoreBundle:MatchTeamOut')
                ->find($id);
            $matchTeamOut->setScore($request->get('teamOutScore'));

            $match = $em
                ->getRepository('CYTNCoreBundle:Matchs')
                ->find($id);
            $match->setIsOpen(false);

            $em->persist($matchTeamIn);
            $em->persist($matchTeamOut);
            $em->persist($match);
            $em->flush();

            $teamInPts = 0;
            $teamInWin = 0;
            $teamInLose = 0;
            $teamInDraw = 0;
            $teamOutPts = 0;
            $teamOutWin = 0;
            $teamOutLose = 0;
            $teamOutDraw = 0;

            if ($request->get('teamInScore') > $request->get('teamOutScore')) {
                $teamInPts = 3;
                $teamInWin = 1;
                $teamOutLose = 1;
            }
            if ($request->get('teamInScore') < $request->get('teamOutScore')) {
                $teamInLose = 1;
                $teamOutPts = 3;
                $teamOutWin = 1;
            }
            if ($request->get('teamInScore') == $request->get('teamOutScore')) {
                $teamInPts = 1;
                $teamInDraw = 1;
                $teamOutPts = 1;
                $teamOutDraw = 1;
            }

            $teamIn = $em
                ->getRepository('CYTNCoreBundle:GroupTeam')
                ->findOneBy(array('group'=>$match->getGroups(), 'team'=>$match->getMatchTeamIn()->getId()));

            $teamIn
                ->setPoint($teamIn->getPoint() + $teamInPts)
                ->setGoalfor($teamIn->getGoalfor() + $request->get('teamInScore'))
                ->setGoalagainst($teamIn->getGoalagainst() + $request->get('teamOutScore'))
                ->setWin($teamIn->getWin() + $teamInWin)
                ->setLose($teamIn->getLose() + $teamInLose)
                ->setDraw($teamIn->getDraw() + $teamInDraw)
            ;
            $em->persist($teamIn);
            $em->flush();

            $teamOut = $em
                ->getRepository('CYTNCoreBundle:GroupTeam')
                ->findOneBy(array('group'=>$match->getGroups(), 'team'=>$match->getMatchTeamOut()->getId()));
            $teamOut
                ->setPoint($teamOut->getPoint() + $teamOutPts)
                ->setGoalfor($teamOut->getGoalfor() + $request->get('teamOutScore'))
                ->setGoalagainst($teamOut->getGoalagainst() + $request->get('teamInScore'))
                ->setWin($teamOut->getWin() + $teamOutWin)
                ->setLose($teamOut->getLose() + $teamOutLose)
                ->setDraw($teamOut->getDraw() + $teamOutDraw)
            ;
            $em->persist($teamOut);
            $em->flush();

            $upd = new \CYTN\CoreBundle\Services\BddRequests($this->getDoctrine()->getManager());
            $upd->updatePoints($id,$request->get('teamInScore'), $request->get('teamOutScore'));


            $request->getSession()->getFlashBag()->add('info', 'Résultat enregistré.');
        }
        return $this->redirectToRoute('cytn_admin_homepage');
    }
}