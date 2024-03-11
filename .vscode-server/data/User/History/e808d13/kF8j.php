<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$interventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);
$photo = $_SESSION['user']['photo'];

$allInterventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);

$interventionsFiltrees = [];

foreach($allInterventions as $one) {
    if($one['statut_suivi'] == "Résolution et clôture du dossier") {
        $interventionsFiltrees[] = $one;
    }
}

echo $page->render('panier.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
