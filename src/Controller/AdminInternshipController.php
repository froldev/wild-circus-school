<?php

namespace App\Controller;

use App\Entity\Internship;
use App\Form\InternshipType;
use App\Repository\InternshipRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/internship", name="admin_internship_")
 */
class AdminInternshipController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function index(InternshipRepository $internshipRepository): Response
    {
        return $this->render('adminInternship/index.html.twig', [
            'internships' => $internshipRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
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

            return $this->redirectToRoute('admin_internship_index');
        }

        return $this->render('adminInternship/new.html.twig', [
            'internship' => $internship,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function show(Internship $internship): Response
    {
        return $this->render('adminInternship/show.html.twig', [
            'internship' => $internship,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function edit(Request $request, Internship $internship): Response
    {
        $form = $this->createForm(InternshipType::class, $internship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_internship_index');
        }

        return $this->render('adminInternship/edit.html.twig', [
            'internship' => $internship,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function delete(Request $request, Internship $internship): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internship->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($internship);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_internship_index');
    }
}
