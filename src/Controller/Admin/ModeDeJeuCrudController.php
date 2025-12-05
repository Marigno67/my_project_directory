<?php

namespace App\Controller\Admin;

use App\Entity\ModeDeJeu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ModeDeJeuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ModeDeJeu::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom');
        yield TextareaField::new('description')
            ->hideOnIndex() // Caché dans la liste (trop long)
            ->setHelp('Description complète du mode de jeu (affichée sur le frontend)');
        yield AssociationField::new('builds')->hideOnForm();
    }
}