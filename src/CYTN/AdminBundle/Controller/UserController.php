<?php

namespace CYTN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CYTN\CoreBundle\Entity\Users;
use CYTN\CoreBundle\Form\UserType;
use CYTN\CoreBundle\Form\UserEditType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function addUserAction(Request $request)
    {
        $users = new Users();
        $form = $this->get('form.factory')->create(new UsersType(), $users);

        if ($form->handleRequest($request)->isValid()) {
            $users->getFlag()->upload();

            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Utilisateur enregistré.');

            return $this->redirect($this->generateUrl('cytn_admin_homepage'));
        }

        return $this->render('CYTNAdminBundle:Default:addUser.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function viewUserAction()
    {
        $users = $this->getDoctrine()
            ->getManager()
            ->getRepository('Users')
            ->findAll();

        return $this->render('CYTNAdminBundle:Default:viewUser.html.twig', array(
            'users' => $users,
        ));
    }

    public function editUserAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('Users')->find($id);

        if (null === $user) {
            throw new NotFoundHttpException("L'utilisateur d'id " . $id . " n'existe pas.");
        }

        $form = $this->createForm(new UsersEditType(), $user);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Utilisateur modifié.');

            return $this->redirect($this->generateUrl('cytn_admin_viewuser', array('id' => $user->getId())));
        }

        return $this->render('CYTNAdminBundle:Default:editUser.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

}