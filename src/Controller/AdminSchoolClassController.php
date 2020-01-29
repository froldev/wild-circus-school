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
 * @Route("admin/class", name="admin_class_")
 */
class AdminSchoolClassController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(SchoolClassRepository $schoolClassRepository): Response
    {
        return $this->render('adminClass/index.html.twig', [
            'school_classes' => $schoolClassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
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

            return $this->redirectToRoute('admin_class_index');
        }

        return $this->render('adminClass/new.html.twig', [
            'school_class' => $schoolClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(SchoolClass $schoolClass): Response
    {
        return $this->render('adminClass/show.html.twig', [
            'school_class' => $schoolClass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SchoolClass $schoolClass): Response
    {
        $form = $this->createForm(SchoolClassType::class, $schoolClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_class_index');
        }

        return $this->render('adminClass/edit.html.twig', [
            'school_class' => $schoolClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, SchoolClass $schoolClass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$schoolClass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($schoolClass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_class_index');
    }
}
