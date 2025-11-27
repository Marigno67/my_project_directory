<?php

namespace App\Controller\Admin;

use App\Entity\SetArtefact;
use App\Form\ImageSetType; // AJOUTER L'IMPORT
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField; // AJOUTER L'IMPORT
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
            CollectionField::new('images')
                ->setEntryType(ImageSetType::class) // Utilise notre mini-formulaire
                ->setFormTypeOption('by_reference', false) // Important pour la sauvegarde
                ->onlyOnForms(), // N'afficher que sur les pages de création/édition
        ];
    }
}