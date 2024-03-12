<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

var_dump($page->session->isConnected());
if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteIntervention($_GET['delete_id']);
}

$interventions = $page->RepoUser->getInterventions();
$photo = $_SESSION['user']['photo'];


echo $page->render('admin.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
