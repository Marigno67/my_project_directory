<?php

namespace App\DataFixtures;

use App\Entity\BonusSet;
use App\Entity\Ombre;
use App\Entity\Personnage;
use App\Entity\SetArtefact;
use App\Entity\StatistiquePersonnage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // ======================================================
        // 1. BIBLIOTHÈQUE DES OMBRES (Indépendantes)
        // ======================================================
        $nomsOmbres = [
            'Igris' => 'Le chevalier rouge sang, loyal et puissant.',
            'Beru'  => 'Le roi des fourmis, capable de parler et de voler.',
            'Tank'  => 'Un ours des glaces massif avec une défense impénétrable.',
            'Iron'  => 'Un chevalier tank, un peu idiot mais très résistant.',
            'Tusk'  => 'Un grand chaman orc capable d\'utiliser la magie.',
            'Kaisel'=> 'La wyverne, monture volante du monarque.',
            'Jima'  => 'Un naga géant utilisant des tridents.',
            'Bellion'=> 'Le grand maréchal de l\'armée des ombres.'
        ];

        foreach ($nomsOmbres as $nom => $desc) {
            $ombre = new Ombre();
            $ombre->setNom($nom);
            $ombre->setDescription($desc);
            // Si tu as une image par défaut
            // $ombre->setImage(strtolower($nom) . '.webp'); 
            
            $manager->persist($ombre);
        }

        // ======================================================
        // 2. BIBLIOTHÈQUE DES SETS D'ARTEFACTS + BONUS
        // ======================================================
        $setsData = [
            'Expert' => ['Augmente l\'XP de 10%', 'Augmente l\'XP de 20%'],
            'Chevalier' => ['Défense +5%', 'Défense +15%'],
            'Sorcier' => ['Dégâts des compétences +10%', 'Réduit le temps de recharge de 15%'],
            'Ténacité' => ['PV +5%', 'PV +15%'],
            'Destructeur' => ['Attaque +10%', 'Dégâts Critiques +20%']
        ];

        foreach ($setsData as $nomSet => $bonusDescriptions) {
            $set = new SetArtefact();
            $set->setNom($nomSet);
            $set->setSousTitre('Set Légendaire'); // Tu peux varier
            $manager->persist($set);

            // Création du Bonus 2 pièces
            $bonus2 = new BonusSet();
            $bonus2->setNombrePieces(2);
            $bonus2->setDescription($bonusDescriptions[0]);
            $bonus2->setSetArtefact($set); // On lie le bonus au set
            $manager->persist($bonus2);

            // Création du Bonus 4 pièces
            $bonus4 = new BonusSet();
            $bonus4->setNombrePieces(4);
            $bonus4->setDescription($bonusDescriptions[1]);
            $bonus4->setSetArtefact($set); // On lie le bonus au set
            $manager->persist($bonus4);
        }

        // ======================================================
        // 3. AJOUT DES STATISTIQUES AUX PERSONNAGES EXISTANTS
        // ======================================================
        // On récupère tes personnages importés via SQL
        $personnages = $manager->getRepository(Personnage::class)->findAll();

        if (!empty($personnages)) {
            $typesStats = ['Force', 'Agilité', 'Intelligence', 'Vitalité', 'Perception'];

            foreach ($personnages as $perso) {
                // On crée les 5 stats pour chaque perso
                foreach ($typesStats as $nomStat) {
                    $stat = new StatistiquePersonnage();
                    $stat->setNom($nomStat);
                    
                    // Valeur aléatoire (plus haute pour Jinwoo)
                    $valeur = (str_contains($perso->getNom(), 'Jinwoo')) ? $faker->numberBetween(200, 500) : $faker->numberBetween(10, 80);
                    $stat->setValeur((string)$valeur);

                    // LIAISON : On ajoute la stat au personnage
                    // Note : Doctrine s'occupe de remplir la table de liaison 'statistique_personnage_personnage'
                    $perso->addStatistique($stat);
                    
                    $manager->persist($stat);
                }
            }
        }

        $manager->flush();
    }
}