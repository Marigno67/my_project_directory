<?php

namespace App\Controller\Admin;

use App\Entity\Build;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BuildCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Build::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('titre');
        yield AssociationField::new('personnage');
        yield AssociationField::new('modeDeJeu');
        
        yield AssociationField::new('equipements')
            ->setFormTypeOptions([
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}