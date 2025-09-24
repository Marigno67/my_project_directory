<?php

namespace App\Controller\Admin;

use App\Entity\Build;
use App\Entity\Equipement;
use App\Entity\ModeDeJeu;
use App\Entity\Personnage;
use App\Entity\SetArtefact;
use App\Entity\BonusSet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ImageSet;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Project Directory');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');

        yield MenuItem::section('Contenu');
        yield MenuItem::linkToCrud('Personnages', 'fas fa-dragon', Personnage::class);
        yield MenuItem::linkToCrud('Modes de jeu', 'fas fa-gamepad', ModeDeJeu::class);
        yield MenuItem::linkToCrud('Builds', 'fas fa-hammer', Build::class);
        yield MenuItem::linkToCrud('Équipements', 'fas fa-shield-alt', Equipement::class);

        // AJOUTER CES DEUX LIGNES
        yield MenuItem::linkToCrud('Sets d\'Artefacts', 'fas fa-layer-group', SetArtefact::class);
        yield MenuItem::linkToCrud('Bonus de Sets', 'fas fa-star', BonusSet::class);
    }
}