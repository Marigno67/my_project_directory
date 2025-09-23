<?php

namespace App\Controller\Admin;

use App\Entity\BonusSet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class BonusSetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BonusSet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('setArtefact'),
            IntegerField::new('nombrePieces'),
            TextEditorField::new('description'), // Permet le gras, les listes, etc.
        ];
    }
}