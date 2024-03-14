<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();


if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if($_SESSION['user']['role_id'] != 4){
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteIntervention($_GET['delete_id']);
}

$interventions = $page->RepoUser->getInterventionsStd($_SESSION['user']['idu']);
$photo = $_SESSION['user']['photo'];

echo $page->render('standardiste.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
