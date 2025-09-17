<?php

namespace App\Controller\Admin;

use App\Entity\ModeDeJeu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Controller\ModeDeJeuApiController;

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
        yield AssociationField::new('builds');
    }
}