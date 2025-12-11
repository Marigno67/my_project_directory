<?php

namespace App\Controller\Admin;

use App\Entity\Noyau;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class NoyauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Noyau::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom', 'Nom du noyau');
        yield AssociationField::new('ensemble', 'Ensemble');
        yield ImageField::new('image', 'Image')
            ->setBasePath('/uploads/images/noyaux')
            ->setUploadDir('public/uploads/images/noyaux')
            ->setUploadedFileNamePattern('[randomhash].[extension]');
        yield TextEditorField::new('description', 'Description')->hideOnIndex();
    }
}
