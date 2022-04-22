<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/produits/{id}", name="produits_detail")
     */
    public function index($id): Response
    {

        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        return $this->render('product/index.html.twig', [
            'name' => $produit->getName(),
            'produit' => $produit,
        ]);
    }
}
