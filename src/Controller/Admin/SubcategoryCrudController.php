<?php

namespace App\Controller\Admin;

use App\Entity\Subcategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SubcategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subcategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Sous-catégorie')
            ->setEntityLabelInPlural('Sous-catégories')
            ->setDefaultSort(['category.name' => 'ASC', 'name' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Nom')->setHelp('Nom de la sous-catégorie');
        yield SlugField::new('slug', 'URL')->setTargetFieldName('name')->setHelp('URL généré automatiquement de la sous-catégorie');
        yield AssociationField::new('category', 'Catégorie')->autocomplete()->setSortProperty('name');
        yield ImageField::new('icon', 'Icône')
            ->setHelp('Icône de la sous-catégorie')
            ->setUploadDir('public/uploads/icons/')
            ->setBasePath('uploads/icons/')
            ->setUploadedFileNamePattern('cat_[year]-[month]-[day]-[contenthash].[extension]')
            ->setRequired(false);
    }
}
