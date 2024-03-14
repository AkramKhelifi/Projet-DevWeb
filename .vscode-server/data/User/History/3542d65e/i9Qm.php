<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];

$interventions = $page->RepoUser->getInterventionsParIntervenant($_SESSION['user']['idu']);
var_dump($page->RepoUser->getInterventionsParIntervenant($_SESSION['user']['idu']));

echo $page->render('intervenant.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
