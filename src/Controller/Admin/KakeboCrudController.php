<?php

namespace App\Controller\Admin;

use App\Entity\Kakebo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class KakeboCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kakebo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Kakebo')
            ->setEntityLabelInPlural('Kakebos')
            ->setDefaultSort(['year_month_date' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield DateField::new('year_month_date', 'Date')->setFormat('yyyy-MM')->setHelp('Date du Kakebo')->hideWhenUpdating()->setHelp('Date du Kakebo');
        yield AssociationField::new('user', 'Utilisateur')->autocomplete()->setHelp('Utilisateur du Kakebo');
        yield TextareaField::new('objectif_reduction', 'Objectif de réduction')->setHelp('L\'utilisateur souhaite réduire les dépenses suivantes');
        yield TextareaField::new('objectif_undertake', 'Objectif à entreprendre')->setHelp('Pour ce faire, l\'utilisateur s\'engage à');
        yield MoneyField::new('save_money', 'Économies')->setCurrency('EUR')->setHelp('Économies à réaliser');
    }
}
