<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
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

    /**
     * @Route("/produits", name="produits")
     */
    public function produits()
    {
        return $this->render('produits/index.html.twig', [
            'name' => 'Produits',
        ]);
    }
}
