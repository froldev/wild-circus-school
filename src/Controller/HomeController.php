<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\CategoryRepository;
use App\Repository\InternshipRepository;
use App\Repository\PartnerRepository;
use App\Repository\SchoolClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        SchoolClassRepository $classRepository,
        InternshipRepository $internshipRepository,
        PartnerRepository $partnerRepository
        ): Response {
        return $this->render('home/index.html.twig', [
            'classes'       => $classRepository->findAll(),
            'internships'   => $internshipRepository->findAll(),
            'partners'      => $partnerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin", name="admin_home")
     */
    public function indexAdmin(
        CategoryRepository $categoryRepository,
        ArtistRepository $artistRepository,
        SchoolClassRepository $classRepository,
        InternshipRepository $internshipRepository
    ): Response {

        return $this->render('admin/index.html.twig', [
            'numberCategory'    => $categoryRepository->countCategories(),
            'numberArtist'      => $artistRepository->countArtists(),
            'numberClass'       => $classRepository->countClasses(),
            'numberInternship'  => $internshipRepository->countInternShips(),
        ]);
    }

    public function renderNavbar(): Response
    {
        return $this->render('blocks/_navbar.html.twig');
    }

}
