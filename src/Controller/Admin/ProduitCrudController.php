<?php

namespace App\Controller\Admin;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
            TextField::new('name', 'Nom')->setRequired(true),
            TextField::new('description', 'Description')->setRequired(true)->onlyOnForms(),
            TextField::new('url')->setRequired(true)->onlyOnForms(),
            TextField::new('image', 'Image')->setRequired(true),
            IntegerField::new('price')->setRequired(true),
            IntegerField::new('stock', 'Stock')->setRequired(true),
            IntegerField::new('rating')->setRequired(true)->onlyOnForms(),
            AssociationField::new('couleur', 'Couleur(s)')->setRequired(true)->onlyOnForms(),
            AssociationField::new('category', 'Categorie(s)')->setRequired(true)->onlyOnForms(),
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