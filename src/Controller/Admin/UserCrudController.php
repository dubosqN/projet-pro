<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Email')
            ->setEntityLabelInPlural('Emails')
            ->setEntityPermission('ROLE_ADMIN')
            ->setSearchFields(null)
            ->setDefaultSort(['email' => 'ASC'])
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom', 'Nom')->setRequired(true),
            TextField::new('prenom', 'Prénom')->setRequired(true),
            ChoiceField::new('genre', 'MR/MME')->setChoices(['Madame' => 'Madame', 'Monsieur' => 'Monsieur'])->setRequired(true),
            TextField::new('email', 'Mail'),
            TextField::new('password', 'Mot de passe')->onlyWhenCreating()->setRequired(true)->setFormType(PasswordType::class),
            TextField::new('password', 'Mot de passe')->onlyWhenUpdating()->setRequired(false)->setFormType(PasswordType::class),
            ChoiceField::new('roles', 'Roles')->setChoices(['ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_PROF' => 'ROLE_PROF'])->allowMultipleChoices()->onlyOnForms(),
            ArrayField::new('roles', 'Roles')->onlyOnIndex(),
        ];
    }
}
