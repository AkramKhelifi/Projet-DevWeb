<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$interventions = $page->getInterventions();
$this->twig->display;

echo $page->render('.html.twig', []);
