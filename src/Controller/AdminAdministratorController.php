<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdministratorType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/administrator", name="admin_administrator_")
 */
class AdminAdministratorController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('adminAdministrator/index.html.twig', [
            'users' => $userRepository->findAdmin(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(AdministratorType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles([User::ROLE_ADMIN]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_administrator_index');
        }

        return $this->render('adminAdministrator/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function show(User $user): Response
    {
        return $this->render('adminAdministrator/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(AdministratorType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_administrator_index');
        }

        return $this->render('adminAdministrator/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_administrator_index');
    }
}
