<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
echo $_SESSION['user']['idu'];

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$interventions = $page->getInterventions();


echo $page->render('profile.html.twig', ['interventions' => $interventions]);
