<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$interventions = $page->getInterventions();
if ($interventions) {
    foreach ($interventions as $intervention) {
        <ul 
    $intervention['nom_intervention'] ;
}}

