<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteIntervention($_GET['delete_id']);
}

$interventions = $page->RepoUser->getInterventions();
$photo = $_SESSION['user']['photo'];

if(isset($_POST['edit'])){
    $nom = 
    $details = 
    $page->RepoUser->updateIntervention()
}


echo $page->render('profile.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
