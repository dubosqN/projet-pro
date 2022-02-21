<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalSpaceController extends AbstractController
{
    /**
     * @Route("/personal_space/mycommands", name="personal_space_mycommands")
     */
    public function myCommands(): Response
    {
        return $this->render('personal_space/mycommands.html.twig', [
            'name' => 'Mes commandes',
        ]);
    }

    /**
     * @Route("/personal_space/mycommands/command", name="personal_space_mycommands_command")
     */
    public function command(): Response
    {
        return $this->render('personal_space/command.html.twig', [
            'name' => 'Commande',
        ]);
    }
    
    /**
     * @Route("/personal_space/myinfos", name="personal_space_myinfos")
     */
    public function myInfos(): Response
    {
        return $this->render('personal_space/myinfos.html.twig', [
            'name' => 'Mes informations',
        ]);
    }

    /**
     * @Route("/personal_space/password", name="personal_space_password")
     */
    public function password(): Response
    {
        return $this->render('personal_space/password.html.twig', [
            'name' => 'Mot de passe',
        ]);
    }

    /**
     * @Route("/personal_space/mypaymentcards", name="personal_space_mypaymentcards")
     */
    public function myPaymentCards(): Response
    {
        return $this->render('personal_space/mypaymentcards.html.twig', [
            'name' => 'Mes cartes de paiement',
        ]);
    }
}
