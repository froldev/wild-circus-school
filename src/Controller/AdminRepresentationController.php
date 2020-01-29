<?php

namespace App\Controller;

use App\Entity\Representation;
use App\Form\RepresentationType;
use App\Repository\RepresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/representation", name="admin_representation_")
 */
class AdminRepresentationController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(RepresentationRepository $representationRepository): Response
    {
        return $this->render('adminRepresentation/index.html.twig', [
            'representations' => $representationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $representation = new Representation();
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($representation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_representation_index');
        }

        return $this->render('adminRepresentation/new.html.twig', [
            'representation' => $representation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Representation $representation): Response
    {
        return $this->render('adminRepresentation/show.html.twig', [
            'representation' => $representation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Representation $representation): Response
    {
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_representation_index');
        }

        return $this->render('adminRepresentation/edit.html.twig', [
            'representation' => $representation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Representation $representation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$representation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($representation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_representation_index');
    }
}
