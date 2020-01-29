<?php

namespace App\Controller;

use App\Entity\SchoolClass;
use App\Form\SchoolClassType;
use App\Repository\SchoolClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/school/class")
 */
class SchoolClassController extends AbstractController
{
    /**
     * @Route("/", name="school_class_index", methods={"GET"})
     */
    public function index(SchoolClassRepository $schoolClassRepository): Response
    {
        return $this->render('school_class/index.html.twig', [
            'school_classes' => $schoolClassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="school_class_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $schoolClass = new SchoolClass();
        $form = $this->createForm(SchoolClassType::class, $schoolClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($schoolClass);
            $entityManager->flush();

            return $this->redirectToRoute('school_class_index');
        }

        return $this->render('school_class/new.html.twig', [
            'school_class' => $schoolClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="school_class_show", methods={"GET"})
     */
    public function show(SchoolClass $schoolClass): Response
    {
        return $this->render('school_class/show.html.twig', [
            'school_class' => $schoolClass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="school_class_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SchoolClass $schoolClass): Response
    {
        $form = $this->createForm(SchoolClassType::class, $schoolClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('school_class_index');
        }

        return $this->render('school_class/edit.html.twig', [
            'school_class' => $schoolClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="school_class_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SchoolClass $schoolClass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$schoolClass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($schoolClass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('school_class_index');
    }
}
