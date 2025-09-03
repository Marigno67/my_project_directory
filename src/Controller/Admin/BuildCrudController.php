<?php

namespace App\Controller\Admin;

use App\Entity\Build;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BuildCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Build::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('titre');
        yield AssociationField::new('personnage');
        yield AssociationField::new('modeDeJeu');
    }
}