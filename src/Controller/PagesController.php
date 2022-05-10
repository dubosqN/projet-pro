<?php

namespace App\Controller;

use App\Entity\Produit;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Algolia\SearchBundle\SearchService;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(SearchService $searchService, SessionInterface $session): Response
    {

        $produits = $this->getDoctrine()->getRepository(Produit::class)->findBy(array(), null, 4);
        $panier = $session->get("panier", []);

        $this->searchService = $searchService;
        return $this->render('accueil/index.html.twig', [
            'name' => 'Accueil',
            'produits' => $produits,
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
