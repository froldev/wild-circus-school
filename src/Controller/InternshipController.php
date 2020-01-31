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
}
