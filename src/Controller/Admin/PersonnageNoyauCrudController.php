<?php

namespace App\Controller\Admin;

use App\Entity\PersonnageNoyau;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PersonnageNoyauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PersonnageNoyau::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('personnage');
        yield AssociationField::new('noyau');
        yield IntegerField::new('priorite')
            ->setHelp('1 = Meilleur choix, 2 = Alternative 1, 3 = Alternative 2, etc.');
    }
}
