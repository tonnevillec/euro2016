<?php

namespace CYTN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CYTN\CoreBundle\Entity\Groups;
use CYTN\CoreBundle\Entity\Teams;
use CYTN\UserBundle\Entity\User;
use CYTN\CoreBundle\Entity\GroupTeam;
use CYTN\CoreBundle\Form\GroupsType;
use CYTN\CoreBundle\Form\GroupsEditType;
use CYTN\CoreBundle\Form\TeamsType;
use CYTN\CoreBundle\Form\TeamsEditType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $teams = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNCoreBundle:Teams')
            ->findAll()
        ;
/*
        $groups = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNCoreBundle:Groups')
            ->findAll()
        ;
*/
        $listGroupTeams = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNCoreBundle:GroupTeam')
            ->findAll()
        ;

        $users = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNUserBundle:User')
            ->findAll()
        ;

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
                array('name'    => 'asc'),
                null,
                null
            );

        return $this->render('CYTNAdminBundle:Default:index.html.twig', array(
            'teams'             => $teams,
            'listGroupTeams'    => $listGroupTeams,
            'users'             => $users,
            'matchs'            => $matchs,
        ));
    }

    public function addTeamAction(Request $request)
    {
        $teams = new Teams();
        $form = $this->get('form.factory')->create(new TeamsType(), $teams);

        if ($form->handleRequest($request)->isValid()) {
            $teams->getFlag()->upload();

            $em = $this->getDoctrine()->getManager();
            $em->persist($teams);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Equipe enregistrée.');

            return $this->redirect($this->generateUrl('cytn_admin_homepage'));
        }

        return $this->render('CYTNAdminBundle:Default:addTeam.html.twig', array(
            'form' => $form->createView(),
        ));        
    }

    public function viewTeamAction()
    {
        $teams = $this->getDoctrine()
            ->getManager()
            ->getRepository('CYTNCoreBundle:Teams')
            ->findAll()
        ;

        return $this->render('CYTNAdminBundle:Default:viewTeam.html.twig', array(
            'teams' => $teams,
        ));
    }

    public function editTeamAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('CYTNCoreBundle:Teams')->find($id);

        if (null === $team) {
            throw new NotFoundHttpException("L'équipe d'id ".$id." n'existe pas.");
        }

        $form = $this->createForm(new TeamsEditType(), $team);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Equipe modifiée.');

            return $this->redirect($this->generateUrl('cytn_admin_viewteam', array('id' => $team->getId())));
        }

        return $this->render('CYTNAdminBundle:Default:editTeam.html.twig', array(
            'form'   => $form->createView(),
            'team'   => $team
        ));
    }


    public function addGroupAction(Request $request)
    {
        $groups = new Groups();
        $form = $this->get('form.factory')->create(new GroupsType(), $groups);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groups);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Groupe enregistré.');

            return $this->redirect($this->generateUrl('cytn_admin_homepage'));
        }

        return $this->render('CYTNAdminBundle:Default:addGroup.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function viewGroupAction()
    {
        $groups = $this->getDoctrine()
            ->getManager()
            ->getRepository('Groups')
            ->findAll()
        ;

        $listGroupTeams = $this->getDoctrine()
            ->getManager()
            ->getRepository('GroupTeam')
            ->findBy(array('groups' => $groups))
        ;

        return $this->render('CYTNAdminBundle:Default:viewGroup.html.twig', array(
            'groups' => $groups,
            'listGroupTeams' => $listGroupTeams,
        ));
    }

    public function editGroupAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository('CYTNCoreBundle:Groups')->find($id);

        if (null === $group) {
            throw new NotFoundHttpException("Le groupe d'id ".$id." n'existe pas.");
        }

        $form = $this->createForm(new GroupsEditType(), $group);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Groupe modifié.');

            return $this->redirect($this->generateUrl('cytn_admin_viewgroup', array('id' => $group->getId())));
        }

        return $this->render('CYTNAdminBundle:Default:editGroup.html.twig', array(
            'form'   => $form->createView(),
            'group'  => $group
        ));
    }
    
}
