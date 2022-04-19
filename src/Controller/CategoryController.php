<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
//    /**
//     * @Route("/category", name="category")
//     */
//    public function index(): Response
//    {
//        return $this->render('category/index.html.twig', [
//            'controller_name' => 'CategoryController',
//        ]);
//    }

    /**
     * @Route("/categorie", name="category_slug")
     */
    public function category_slug(): Response
    {
        return $this->render('category/index.html.twig', [
            'name' => 'Categories',
        ]);
    }
}