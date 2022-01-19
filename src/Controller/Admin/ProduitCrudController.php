<?php

namespace App\Controller\Admin;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Form\ImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureFields(string $pageName): iterable

    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom')->setRequired(true),
            AssociationField::new('couleur', 'Couleur(s)')->setRequired(true),
            //TextAreaField::new('photoFile', 'Photo de couverture')->setFormType(VichImageType::class)->setRequired(true)->setFormTypeOptions(['allow_delete' => false ])->onlyOnForms(),
            //ImageField::new('photo')->setBasePath('/images/photos')->hideOnForm(),
            //CollectionField::new('images')->setEntryType(ImagesType::class)->onlyOnForms(),
            //CollectionField::new('images')->setTemplatePath('images.html.twig')->onlyOnDetail(),
        
        ];
        
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');

    }

}