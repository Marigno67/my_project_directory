<?php

namespace App\Controller\Admin;

use App\Entity\Build;
use App\Entity\Equipement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Doctrine\ORM\EntityManagerInterface;

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

    public function createEntity(string $entityFqcn)
    {
        $build = new Build();
        
        // Récupère tous les équipements existants
        $equipementRepository = $this->container->get('doctrine')->getRepository(Equipement::class);
        $allEquipements = $equipementRepository->findAll();
        
        // Ajoute chaque équipement au nouveau build
        foreach ($allEquipements as $equipement) {
            $build->addEquipement($equipement);
        }
        
        return $build;
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