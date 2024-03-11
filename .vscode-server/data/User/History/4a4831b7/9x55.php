<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
    exit; // Important pour stopper l'exécution du script après une redirection
}

// Récupère toutes les interventions de l'utilisateur
$allInterventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);

// Filtrer pour garder uniquement les interventions critiques
$interventionsCritiques = array_filter($allInterventions, function($one) {
    return $one['statut_suivi'] == "critique";
});

// Photo de l'utilisateur
$photo = $_SESSION['user']['photo'];

// Affiche le template avec les interventions filtrées et la photo
echo $page->render('historique.html.twig', [
    'interventions' => $interventionsCritiques,
    'photo' => $photo
]);
