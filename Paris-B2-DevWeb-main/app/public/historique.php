<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
    exit; 
}

$allInterventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);

$interventionsFiltrees = [];

foreach($allInterventions as $one) {
    if($one['statut_suivi'] == "Cloturer") {
        $interventionsFiltrees[] = $one;
    }
}

$photo = $_SESSION['user']['photo'];

echo $page->render('historique.html.twig', [
    'interventions' => $interventionsFiltrees,
    'photo' => $photo
]);
