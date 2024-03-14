<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];

$Interventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);


echo $page->render('intervenant.html.twig', ['interventions' => $interventionsFiltrees,
'photo' => $photo]);
