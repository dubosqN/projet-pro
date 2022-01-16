<?php

namespace App\Controller\Admin;
use App\Entity\Couleur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class CouleurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Couleur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom', 'Libelle')->setRequired(true),
            TextField::new('hex', 'Hex')->setRequired(true),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');

    }

}