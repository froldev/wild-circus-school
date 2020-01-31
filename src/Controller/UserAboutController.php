<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/about", name="about_")
 */
class UserAboutController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        return $this->render('userAbout/index.html.twig', [
            'artists' => $artistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Artist $artist): Response
    {
        return $this->render('userAbout/show.html.twig', [
            'artist' => $artist,
        ]);
    }
}
