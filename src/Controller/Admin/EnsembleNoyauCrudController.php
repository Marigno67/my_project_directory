<?php

namespace App\Controller\Admin;

use App\Entity\EnsembleNoyau;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class EnsembleNoyauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EnsembleNoyau::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom', 'Nom de l\'ensemble');
        yield AssociationField::new('noyaux', 'Noyaux')->hideOnForm();
    }
}
