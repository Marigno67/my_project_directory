<?php

namespace App\Controller\Admin;

use App\Entity\Arme;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ArmeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Arme::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom');
        yield AssociationField::new('element');
        yield TextEditorField::new('description');

        yield ImageField::new('image')
            ->setBasePath('/uploads/images/armes')
            ->setUploadDir('public/uploads/images/armes')
            ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setLabel('Image de l\'arme');
    }
}
