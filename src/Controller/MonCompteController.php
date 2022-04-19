<?php

namespace App\Controller;

use App\Entity\Cartes;
use App\Entity\Commandes;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

class MonCompteController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(UserInterface $user, Request $request, EntityManagerInterface $entityManager): Response
    {

        $userInfos = $this->getDoctrine()->getRepository(User::class)->find($user);
        $cartes = $this->getDoctrine()->getRepository(Cartes::class)->find($user);
        $commandes = $this->getDoctrine()->getRepository(Commandes::class)->findByUser($user);


        $userForm = $this->createFormBuilder($user)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', TextType::class)
            ->add('adresse', TextType::class)
            ->add('ville', TextType::class)
            ->add('cp', TextType::class)
            ->add('enregistrer', SubmitType::class)
            ->getForm();

        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $user = $userForm->getData();

            $entityManager->persist($user);
            $entityManager->flush();
        }


        return $this->renderForm('mon_compte/index.html.twig', [
            'name' => 'Mon compte',
            'user' => $user,
            'commandes' => $commandes,
            'cartes' => $cartes,
            'informationsForm' => $userForm,
        ]);
    }
}
