<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
    exit; // Assurez-vous que le script cesse de s'exécuter après une redirection
}

// Récupère toutes les interventions de l'utilisateur connecté
$allInterventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);

// Initialise un tableau pour les interventions filtrées
$interventionsFiltrees = [];

// Parcourt toutes les interventions pour filtrer celles ayant le statut "Résolution et clôture du dossier"
foreach($allInterventions as $one) {
    if($one['statut_suivi'] == "Résolution et clôture du dossier") {
        $interventionsFiltrees[] = $one;
    }
}

// Récupère la photo de l'utilisateur à partir de la session
$photo = $_SESSION['user']['photo'];

// Affiche la page avec les données filtrées
echo $page->render('historique.html.twig', [
    'interventions' => $interventionsFiltrees,
    'photo' => $photo
]);
