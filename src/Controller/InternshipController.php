<?php

namespace App\Controller;

use App\Entity\Internship;
use App\Form\InternshipType;
use App\Repository\InternshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/internship")
 */
class InternshipController extends AbstractController
{
    /**
     * @Route("/", name="internship_index", methods={"GET"})
     */
    public function index(InternshipRepository $internshipRepository): Response
    {
        return $this->render('internship/index.html.twig', [
            'internships' => $internshipRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="internship_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $internship = new Internship();
        $form = $this->createForm(InternshipType::class, $internship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($internship);
            $entityManager->flush();

            return $this->redirectToRoute('internship_index');
        }

        return $this->render('internship/new.html.twig', [
            'internship' => $internship,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="internship_show", methods={"GET"})
     */
    public function show(Internship $internship): Response
    {
        return $this->render('internship/show.html.twig', [
            'internship' => $internship,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="internship_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Internship $internship): Response
    {
        $form = $this->createForm(InternshipType::class, $internship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('internship_index');
        }

        return $this->render('internship/edit.html.twig', [
            'internship' => $internship,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="internship_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Internship $internship): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internship->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($internship);
            $entityManager->flush();
        }

        return $this->redirectToRoute('internship_index');
    }
}
