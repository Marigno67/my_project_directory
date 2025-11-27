<?php

namespace App\Controller\Admin;

use App\Entity\StatistiquePersonnage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatistiquePersonnageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatistiquePersonnage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('valeur'),
            AssociationField::new('personnages')
                ->setFormTypeOptions([
                    'multiple' => true,
                    'expanded' => false, // Pour avoir une liste déroulante (mettez true pour des cases à cocher)
                ]),
        ];
    }
}