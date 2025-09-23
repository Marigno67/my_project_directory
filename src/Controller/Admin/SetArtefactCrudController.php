<?php

namespace App\Controller\Admin;

use App\Entity\SetArtefact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SetArtefactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SetArtefact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('sousTitre'),
            ImageField::new('image')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images'),
        ];
    }
}