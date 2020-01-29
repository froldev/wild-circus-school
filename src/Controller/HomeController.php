<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/admin", name="admin_index")
     */
    public function admin(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function renderNavbar(): Response
    {
        return $this->render('blocks/_navbar.html.twig');
    }
}
