<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session, ProduitRepository $produitRepository)
    {

        $panier = $this->calculPanier($session, $produitRepository);

        $dataPanier = $panier["dataPanier"];
        $total = $panier["total"];
        $qtty = $panier["qtty"];

        return $this->render('cart/index.html.twig', compact("dataPanier", "total", "qtty"));
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(Produit $product, SessionInterface $session)
    {
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Produit $product, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Produit $product, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("cart_index");
    }


    /**
     * @Route("/adresse", name="adresse")
     */
    public function adresse(SessionInterface $session, ProduitRepository $productsRepository){
        $panier = $this->calculPanier($session, $productsRepository);

        $dataPanier = $panier["dataPanier"];
        $total = $panier["total"];
        $qtty = $panier["qtty"];


        return $this->render('cart/adresse.html.twig', compact("dataPanier", "total", "qtty"));
    }

    /**
     * @Route("/adresse_add", name="adresse_add")
     */
    public function adresseAdd(SessionInterface $session, ProduitRepository $productsRepository){
        $panier = $session->get("panier", []);

        $session->set("panier", $panier);
    }

    /**
     * @Route("/checkout", name="payment_checkout")
     */
    public function checkout(SessionInterface $session, ProduitRepository $productsRepository){


        $panier = $this->calculPanier($session, $productsRepository);
        $total = $panier["total"];

        Stripe::setApiKey('sk_test_51KuJ8TF661nv3xYDcuxj8T0EmniTHqnXcfDUJyqve6niX8CeNmTDpuHDUdYtbSBUu1PhI7rjIXHokGBjrI5YYb7E00mXSGKdbT');

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => 'Commande SIRIO d\'un montant de',
                        ],
                        'unit_amount'  => $total * 100,
                    ],
                    'quantity'   => 1,
                ]
            ],
            'mode'                 => 'payment',
            'success_url'          => $this->generateUrl('cart_successpayment', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url'           => $this->generateUrl('cart_cancelpayment', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($session->url, 303);
    }


    /**
     * @Route("/success", name="successpayment")
     */
    public function successUrl()
    {
        return $this->render('cart/success.html.twig', []);
    }


    /**
     * @Route("/cancel", name="cancelpayment")
     */
    public function cancelUrl()
    {
        return $this->render('cart/cancel.html.twig', []);
    }

    public function calculPanier($session, $productsRepository){
        $panier = $session->get("panier", []);
        $dataPanier = [];
        $total = 0;
        $qtty = 0;


        foreach($panier as $id => $quantite){
            $product = $productsRepository->find($id);
            $dataPanier[] = [
                "produit" => $product,
                "quantite" => $quantite,
            ];
            $qtty += $quantite;
            $total += $product->getPrice() * $quantite;
        }

        return array(
            "dataPanier" => $dataPanier,
            "qtty" => $qtty,
            "total" => $total
        );
    }
}