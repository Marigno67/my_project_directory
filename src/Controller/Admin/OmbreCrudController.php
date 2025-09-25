<?php

namespace App\Controller\Admin;

use App\Entity\Ombre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OmbreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ombre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            ImageField::new('image')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images'),
            TextEditorField::new('description'),
        ];
    }
}