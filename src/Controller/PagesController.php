<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Algolia\SearchBundle\SearchService;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(SearchService $searchService): Response
    {
        $this->searchService = $searchService;
        return $this->render('accueil/index.html.twig', [
            'name' => 'Accueil',
        ]);
    }
}
