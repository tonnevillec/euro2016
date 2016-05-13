<?php

namespace CYTN\CoreBundle\Controller;

use CYTN\CoreBundle\Entity\Deals;
use CYTN\CoreBundle\Entity\Matchs;
use CYTN\CoreBundle\Entity\MatchsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if(!$this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute('fos_user_security_login');
        }
/*
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('username' => 'tonnevillec'));
        $roles=array('ROLE_ADMIN');
        $user->setRoles($roles);
        $userManager->updateUser($user);
*/

        $matchs = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNCoreBundle:Matchs')
            ->findAll()
        ;

        $groups = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNCoreBundle:Groups')
            ->findBy(
                array('round'   => 'GROUPE'),
                array('name'    => 'asc'
                ),
                null,
                null
            );

        $classifiy = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNCoreBundle:GroupTeam')
            ->findBy(
                array('group' => $groups),
                array(
                    'group'         => 'asc',
                    'point'         => 'desc',
                    'win'           => 'desc',
                    'draw'          => 'desc',
                    'goalfor'       => 'desc',
                    'goalagainst'   => 'asc',
                    'team'          => 'asc'
                ),
                null,
                null
            );
        ;

        return $this->render('CYTNCoreBundle:Common:dashboard.html.twig', array(
            'matchs'        => $matchs,
            'classify'      => $classifiy
        ));
    }

    public function addDealAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $matchs = $em
                ->getRepository('CYTNCoreBundle:Matchs')
                ->findAllOpen()
            ;

            foreach ($matchs as $match){
                $entityMatch = $em
                    ->getRepository('CYTNCoreBundle:Matchs')
                    ->find($match->getId());

                $entityDeal = $em
                    ->getRepository('CYTNCoreBundle:Deals')
                    ->findOneBy(array('match'=>$entityMatch, 'user'=>$this->getUser()));

                if($entityDeal !== NULL){
                    // Update
                    $entityDeal->setInScore($request->get('inScore'.$match->getId()));
                    $entityDeal->setOutScore($request->get('outScore'.$match->getId()));
                    $entityDeal->setMatch($entityMatch);
                    $entityDeal->setUser($this->getUser());

                    $em->persist($entityDeal);
                }
                else{
                    $deal = new Deals();

                    $deal->setInScore($request->get('inScore'.$match->getId()));
                    $deal->setOutScore($request->get('outScore'.$match->getId()));
                    $deal->setMatch($entityMatch);
                    $deal->setUser($this->getUser());

                    $em->persist($deal);
                }
                $em->flush();
            }

            $request->getSession()->getFlashBag()->add('info', 'Pronostics enregistrés.');
        }

        return $this->redirectToRoute('cytn_core_homepage');
    }

}