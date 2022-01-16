<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Couleur;

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index(): Response
    {
        return parent::index();

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sirio - Administration')
            ->setFaviconPath('');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Voir le site', 'fa fa-globe', 'accueil'),
            MenuItem::section('Contenu'),
            MenuItem::linkToCrud('Produits', 'fas fa-question', Produit::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Couleurs', 'fas fa-color', Couleur::class)->setPermission('ROLE_ADMIN'),

            MenuItem::section('Utilisateurs')->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Comptes', 'fa fa-user', User::class)->setPermission('ROLE_ADMIN'),
        ];
    }

/*    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('build/css/admin.min.css');
    }*/
}
