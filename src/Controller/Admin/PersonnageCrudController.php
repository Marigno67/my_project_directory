<?php

namespace App\Controller\Admin;

use App\Entity\Personnage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField; // Ajoutez cette ligne

class PersonnageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Personnage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm(); // Cache le champ ID dans le formulaire
        yield TextField::new('nom');
        yield TextEditorField::new('description'); // Utilisez TextEditorField pour une description plus longue

        yield ImageField::new('image')
            ->setBasePath('/uploads/images')
            ->setUploadDir('public/uploads/images')
            ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setLabel('Image du personnage');
    }
}