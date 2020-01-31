<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Category;
use App\Entity\SchoolClass;
use App\Form\SchoolClassType;
use App\Repository\SchoolClassRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function index(SchoolClassRepository $schoolClassRepository): Response
    {
        return $this->render('adminSchoolClass/index.html.twig', [
            'classes' => $schoolClassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
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

        return $this->render('adminSchoolClass/new.html.twig', [
            'class' => $schoolClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function show(SchoolClass $schoolClass): Response
    {
        return $this->render('adminSchoolClass/show.html.twig', [
            'class' => $schoolClass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
     */
    public function edit(
        Request $request,
        SchoolClass $schoolClass,
        Artist $artist
    ): Response {
        $form = $this->createForm(SchoolClassType::class, $schoolClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $schoolClass->addArtist($artist);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_class_index');
        }

        return $this->render('adminSchoolClass/edit.html.twig', [
            'class' => $schoolClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN", statusCode=404)
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
