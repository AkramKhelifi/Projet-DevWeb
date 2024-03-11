<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$interventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);
$photo = $_SESSION['user']['photo'];


echo $page->render('panier.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
