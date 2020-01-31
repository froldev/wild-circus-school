<?php

namespace App\Controller;

use App\Entity\SchoolClass;
use App\Form\SchoolClassType;
use App\Repository\ArtistRepository;
use App\Repository\SchoolClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/school/class", name="class_")
 */
class SchoolClassController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(SchoolClassRepository $schoolClassRepository): Response
    {
        return $this->render('class/index.html.twig', [
            'classes'   => $schoolClassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(
        SchoolClass $schoolClass,
        ArtistRepository $artistRepository
    ): Response {
        return $this->render('class/show.html.twig', [
            'class'     => $schoolClass,
            'artists'   => $artistRepository->findArtistsByClass($schoolClass),
        ]);
    }

}
